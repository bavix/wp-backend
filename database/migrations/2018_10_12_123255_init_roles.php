<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Permission;
use App\Models\Role;

class InitRoles extends Migration
{

    /**
     * @param Role $from
     * @param Role $to
     */
    protected function syncPermissions(Role $from, Role $to): void
    {
        $permissions = $from->permissions()
            ->get()
            ->pluck('id')
            ->toArray();

        $to->syncPermissions($permissions);
    }

    /**
     * @param Role $role
     */
    protected function blocked(Role $role): void
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
    }

    /**
     * @param Role $role
     */
    protected function registered(Role $role): void
    {
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
         * @var Role $blocked
         * @var Role $developer
         * @var Role $registered
         */
        $blocked = Role::query()->create([
            'name' => \Illuminate\Support\Str::title(Role::BLOCKED),
            'slug' => str_slug(Role::BLOCKED),
            'system' => true,
            'description' => 'Blocked role.',
        ]);

        $this->blocked($blocked);

        $registered = Role::query()->create([
            'name' => \Illuminate\Support\Str::title(Role::REGISTERED),
            'slug' => str_slug(Role::REGISTERED),
            'system' => true,
            'description' => 'Registered role.',
        ]);

        $this->syncPermissions($blocked, $registered);
        $this->registered($registered);

        $user = Role::query()->create([
            'name' => \Illuminate\Support\Str::title(Role::USER),
            'slug' => str_slug(Role::USER),
            'system' => true,
            'description' => 'User role.',
        ]);

        $this->syncPermissions($registered, $user);
        $this->user($user);

        $developer = Role::query()->create([
            'name' => \Illuminate\Support\Str::title(Role::DEVELOPER),
            'slug' => str_slug(Role::DEVELOPER),
            'system' => true,
            'description' => 'Developer role.',
        ]);

        $this->syncPermissions($user, $developer);
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
         * @var Role $blocked
         * @var Role $developer
         * @var Role $registered
         */
        $developer = Role::query()
            ->where('slug', Role::DEVELOPER)
            ->firstOrFail();

        $user = Role::query()
            ->where('slug', Role::USER)
            ->firstOrFail();

        $blocked = Role::query()
            ->where('slug', Role::BLOCKED)
            ->firstOrFail();

        $registered = Role::query()
            ->where('slug', Role::REGISTERED)
            ->firstOrFail();

        $registered->syncPermissions();
        $developer->syncPermissions();
        $blocked->syncPermissions();
        $user->syncPermissions();

        $user->forceDelete();
        $blocked->forceDelete();
        $developer->forceDelete();
        $registered->forceDelete();

        Permission::query()->forceDelete();
    }

}
