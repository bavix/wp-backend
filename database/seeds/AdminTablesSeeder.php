<?php

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Administrator::truncate();
        Administrator::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => 'Administrator',
        ]);

        // create a role.
        Role::truncate();
        Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'name' => 'All permission',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*',
            ],
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/',
            ],
            [
                'name' => 'Login',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => "/auth/login\r\n/auth/logout",
            ],
            [
                'name' => 'User setting',
                'slug' => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path' => '/auth/setting',
            ],
            [
                'name' => 'Auth management',
                'slug' => 'auth.management',
                'http_method' => '',
                'http_path' => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
        ]);

        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Dashboard',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Brands',
                'icon' => 'fa-building-o',
                'uri' => 'brands',
            ],
            [
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Styles',
                'icon' => 'fa-star-o',
                'uri' => 'styles',
            ],
            [
                'parent_id' => 0,
                'order' => 4,
                'title' => 'Collections',
                'icon' => 'fa-object-group',
                'uri' => 'collections',
            ],
            [
                'parent_id' => 0,
                'order' => 5,
                'title' => 'Wheels',
                'icon' => 'fa-circle-thin',
                'uri' => 'wheels',
            ],

            // users
            [
                'parent_id' => 0,
                'order' => 6,
                'title' => 'Management of users',
                'icon' => 'fa-users',
                'uri' => '#',
            ],
            [
                'parent_id' => 6,
                'order' => 7,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'users',
            ],
            [
                'parent_id' => 6,
                'order' => 8,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'roles',
            ],
            [
                'parent_id' => 6,
                'order' => 9,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'permissions',
            ],

            // cp
            [
                'parent_id' => 0,
                'order' => 10,
                'title' => 'Control Panel',
                'icon' => 'fa-tasks',
                'uri' => '#',
            ],
            [
                'parent_id' => 10,
                'order' => 11,
                'title' => 'Managers',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
            ],
            [
                'parent_id' => 10,
                'order' => 12,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
            ],
            [
                'parent_id' => 10,
                'order' => 13,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
            ],
            [
                'parent_id' => 10,
                'order' => 14,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
            ],
            [
                'parent_id' => 10,
                'order' => 15,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
            ],
            [
                'parent_id' => 10,
                'order' => 16,
                'title' => 'Config',
                'icon' => 'fa-cog',
                'uri' => 'config',
            ],
            [
                'parent_id' => 10,
                'order' => 17,
                'title' => 'OAuth Client',
                'icon' => 'fa-sign-in',
                'uri' => 'oauth-client',
            ],
        ]);

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
        \Encore\Admin\Helpers\Helpers::import();
    }
}
