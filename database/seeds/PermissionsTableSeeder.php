<?php

use Illuminate\Database\Seeder;
use App\Enums\PermissionEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Администраторы
     *
     * @var array
     */
    protected static $admins = [
        'rez1dent3',
        'Alexgatorr',
        'a_d_69',
    ];

    /**
     * @var array
     */
    protected static $managers = [
        'rez1dent3',
        'Alexgatorr',
        'a_d_69',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = $this->admin();
        $manager = $this->catalogueManager();
        $simple = $this->user();

        User::query()->each(function (User $user) use ($admin, $manager, $simple) {
            $roles = [$simple];
            if (\in_array($user->login, static::$managers, true)) {
                $roles[] = $manager;
            }
            if (\in_array($user->login, static::$admins, true)) {
                $roles[] = $admin;
            }
            $user->assignRole($roles);
        });
    }

    /**
     * @return Role
     */
    protected function admin(): Role
    {
        return $this->givePermissionTo('admin', [
            PermissionEnum::NOVA_VIEW,
            PermissionEnum::SWAGGER_VIEW,
        ]);
    }

    /**
     * @return Role
     */
    protected function catalogueManager(): Role
    {
        return $this->givePermissionTo('catalogue manager', [
            PermissionEnum::ADDRESSES_VIEW,
            PermissionEnum::ADDRESSES_CREATE,
            PermissionEnum::ADDRESSES_UPDATE,
            PermissionEnum::ADDRESSES_DELETE,

            PermissionEnum::BRANDS_VIEW,
            PermissionEnum::BRANDS_CREATE,
            PermissionEnum::BRANDS_UPDATE,
            PermissionEnum::BRANDS_DELETE,

            PermissionEnum::COLLECTIONS_VIEW,
            PermissionEnum::COLLECTIONS_CREATE,
            PermissionEnum::COLLECTIONS_UPDATE,
            PermissionEnum::COLLECTIONS_DELETE,

            PermissionEnum::STYLES_VIEW,
            PermissionEnum::STYLES_CREATE,
            PermissionEnum::STYLES_UPDATE,
            PermissionEnum::STYLES_DELETE,

            PermissionEnum::WHEELS_VIEW,
            PermissionEnum::WHEELS_CREATE,
            PermissionEnum::WHEELS_UPDATE,
            PermissionEnum::WHEELS_DELETE,
        ]);
    }

    /**
     * @return Role
     */
    protected function user(): Role
    {
        return $this->givePermissionTo('user', [
            PermissionEnum::PROFILE_VIEW,
            PermissionEnum::PROFILE_UPDATE,
            PermissionEnum::PROFILE_DELETE,
            PermissionEnum::PROFILE_PHOTO,

            PermissionEnum::WHEELS_LIKE,
            PermissionEnum::WHEELS_UNLIKE,
            PermissionEnum::WHEELS_FOLLOW,
            PermissionEnum::WHEELS_UNFOLLOW,
        ]);
    }

    /**
     * @param string $roleName
     * @param array $names
     * @return Role
     */
    protected function givePermissionTo(string $roleName, array $names): Role
    {
        $role = Role::firstOrCreate(['name' => $roleName]);

        $permissions = [];
        foreach ($names as $name) {
            $permissions[] = Permission::firstOrCreate([
                'name' => $name,
            ]);
        }

        $role->syncPermissions($permissions);
        foreach ($permissions as $permission) {
            $permission->syncRoles($role);
        }

        return $role;
    }

}
