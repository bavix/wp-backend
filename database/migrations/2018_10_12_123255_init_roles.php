<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use App\Models\Permission;
use App\Models\Role;

class InitRoles extends Migration
{

    /**
     * @param Role $role
     */
    protected function registered(Role $role): void
    {
        Permission::createResource(Permission::RESOURCE_PROFILE);

        $permissions = Permission::query()
            ->where('resource', Permission::RESOURCE_PROFILE)
            ->orWhereIn('slug', [
                Permission::COLLECTIONS_VIEW,
                Permission::ADDRESSES_VIEW,
                Permission::BRANDS_VIEW,
                Permission::WHEELS_VIEW,
            ])
            ->get();

        /**
         * @var Permission[] $permissions
         */
        foreach ($permissions as $permission) {
            $role->assignPermission($permission->getKey());
        }

        // like
        $like = Permission::query()->create([
            'slug'     => Permission::WHEELS_LIKE,
            'resource' => Permission::RESOURCE_WHEELS,
            'name'     => 'Like wheels',
            'system'   => false,
        ]);

        $role->assignPermission($like->getKey());

        $unlike = Permission::query()->create([
            'slug'     => Permission::WHEELS_UNLIKE,
            'resource' => Permission::RESOURCE_WHEELS,
            'name'     => 'UnLike wheels',
            'system'   => false,
        ]);

        $role->assignPermission($unlike->getKey());

        // follow
        $follow = Permission::query()->create([
            'slug'     => Permission::WHEELS_FOLLOW,
            'resource' => Permission::RESOURCE_WHEELS,
            'name'     => 'Follow wheels',
            'system'   => false,
        ]);

        $role->assignPermission($follow->getKey());

        $unfollow = Permission::query()->create([
            'slug'     => Permission::WHEELS_UNFOLLOW,
            'resource' => Permission::RESOURCE_WHEELS,
            'name'     => 'UnFollow wheels',
            'system'   => false,
        ]);

        $role->assignPermission($unfollow->getKey());

        // profile
        $photo = Permission::query()->create([
            'slug'     => Permission::PROFILE_PHOTO,
            'resource' => Permission::RESOURCE_PROFILE,
            'name'     => 'Upload a photo to your profile',
            'system'   => false,
        ]);

        $role->assignPermission($photo->getKey());
    }

    /**
     * @param Role $role
     */
    protected function user(Role $role): void
    {
        // todo
    }

    /**
     * @param Role $role
     */
    protected function developer(Role $role): void
    {
        $swagger = Permission::query()->create([
            'slug'     => Permission::SWAGGER_VIEW,
            'resource' => Permission::RESOURCE_SWAGGER,
            'name'     => 'View swagger',
            'system'   => false,
        ]);

        $role->assignPermission($swagger->getKey());
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::createResource(Permission::RESOURCE_COLLECTIONS);
        Permission::createResource(Permission::RESOURCE_ADDRESSES);
        Permission::createResource(Permission::RESOURCE_BRANDS);
        Permission::createResource(Permission::RESOURCE_WHEELS);
        Permission::createResource(Permission::RESOURCE_STYLES);

        /**
         * @var Role $user
         * @var Role $developer
         * @var Role $registered
         */
        $registered = Role::query()->create([
            'name' => Str::title(Role::REGISTERED),
            'slug' => Str::slug(Role::REGISTERED),
            'system' => true,
            'description' => 'Registered role.',
        ]);

        $this->registered($registered);

        $user = Role::query()->create([
            'name' => Str::title(Role::USER),
            'slug' => Str::slug(Role::USER),
            'system' => true,
            'description' => 'User role.',
        ]);

        $this->user($user);

        $developer = Role::query()->create([
            'name' => Str::title(Role::DEVELOPER),
            'slug' => Str::slug(Role::DEVELOPER),
            'system' => true,
            'description' => 'Developer role.',
        ]);

        $this->developer($developer);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * @var Role $user
         * @var Role $developer
         * @var Role $registered
         */
        $developer = Role::query()
            ->where('slug', Role::DEVELOPER)
            ->firstOrFail();

        $user = Role::query()
            ->where('slug', Role::USER)
            ->firstOrFail();

        $registered = Role::query()
            ->where('slug', Role::REGISTERED)
            ->firstOrFail();

        $registered->syncPermissions();
        $developer->syncPermissions();
        $user->syncPermissions();

        $user->forceDelete();
        $developer->forceDelete();
        $registered->forceDelete();

        Permission::query()->forceDelete();
    }

}
