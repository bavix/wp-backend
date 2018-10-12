<?php

use Illuminate\Database\Migrations\Migration;
use Yajra\Acl\Models\Permission;
use Yajra\Acl\Models\Role;

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
        Permission::createResource('profile');

        $permissions = Permission::query()
            ->where('resource', 'profile')
            ->orWhereIn('slug', [
                'collections.view',
                'addresses.view',
                'brands.view',
                'wheels.view',
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
            'slug'     => 'wheels.like',
            'resource' => 'wheels',
            'name'     => 'Like wheels',
            'system'   => false,
        ]);

        $role->assignPermission($like->getKey());

        $unlike = Permission::query()->create([
            'slug'     => 'wheels.unlike',
            'resource' => 'wheels',
            'name'     => 'UnLike wheels',
            'system'   => false,
        ]);

        $role->assignPermission($unlike->getKey());

        // follow
        $follow = Permission::query()->create([
            'slug'     => 'wheels.follow',
            'resource' => 'wheels',
            'name'     => 'Follow wheels',
            'system'   => false,
        ]);

        $role->assignPermission($follow->getKey());

        $unfollow = Permission::query()->create([
            'slug'     => 'wheels.unfollow',
            'resource' => 'wheels',
            'name'     => 'UnFollow wheels',
            'system'   => false,
        ]);

        $role->assignPermission($unfollow->getKey());

        // profile
        $photo = Permission::query()->create([
            'slug'     => 'profile.photo',
            'resource' => 'profile',
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
            'slug'     => 'swagger.view',
            'resource' => 'swagger',
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
        Permission::createResource('collections');
        Permission::createResource('addresses');
        Permission::createResource('brands');
        Permission::createResource('wheels');
        Permission::createResource('styles');

        /**
         * @var Role $user
         * @var Role $blocked
         * @var Role $developer
         * @var Role $registered
         */
        $blocked = Role::query()->create([
            'name' => \Illuminate\Support\Str::title('blocked'),
            'slug' => str_slug('blocked'),
            'system' => true,
            'description' => 'Blocked role.',
        ]);

        $this->blocked($blocked);

        $registered = Role::query()->create([
            'name' => \Illuminate\Support\Str::title('registered'),
            'slug' => str_slug('registered'),
            'system' => true,
            'description' => 'Registered role.',
        ]);

        $this->syncPermissions($blocked, $registered);
        $this->registered($registered);

        $user = Role::query()->create([
            'name' => \Illuminate\Support\Str::title('user'),
            'slug' => str_slug('user'),
            'system' => true,
            'description' => 'User role.',
        ]);

        $this->syncPermissions($registered, $user);
        $this->user($user);

        $developer = Role::query()->create([
            'name' => \Illuminate\Support\Str::title('developer'),
            'slug' => str_slug('developer'),
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
            ->where('slug', 'developer')
            ->firstOrFail();

        $user = Role::query()
            ->where('slug', 'user')
            ->firstOrFail();

        $blocked = Role::query()
            ->where('slug', 'blocked')
            ->firstOrFail();

        $registered = Role::query()
            ->where('slug', 'registered')
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
