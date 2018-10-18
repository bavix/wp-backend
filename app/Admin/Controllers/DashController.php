<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Style;
use App\Models\User;
use App\Models\Wheel;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use App\Models\Permission;
use App\Models\Role;

class DashController extends Controller
{

    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        $content->row(function (Row $row) {

            $row->column(
                3,
                new InfoBox(
                    'Users',
                    'users',
                    'aqua',
                    route('cp.users.index'),
                    $this->info(User::class)
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Wheels',
                    'circle-thin',
                    'green',
                    route('cp.wheels.index'),
                    $this->info(Wheel::class)
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Brands',
                    'building-o',
                    'red',
                    route('cp.brands.index'),
                    $this->info(Brand::class)
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Collections',
                    'object-group',
                    'blue',
                    route('cp.collections.index'),
                    $this->info(Collection::class)
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Styles',
                    'star-o',
                    'yellow',
                    route('cp.styles.index'),
                    $this->info(Style::class)
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Roles',
                    'user',
                    'info',
                    route('cp.roles.index'),
                    $this->info(Role::class)
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Permissions',
                    'ban',
                    'aqua',
                    route('cp.permissions.index'),
                    $this->info(Permission::class)
                )
            );
        });

        return $content
            ->header('Dashboard')
            ->description('description');
    }

    /**
     * @param string $class
     * @return string
     */
    protected function info(string $class): string
    {
        try {
            return $class::whereEnabled(true)->count() . '/' . $class::count();
        } catch (\Throwable $throwable) {
            return $class::count();
        }
    }

}
