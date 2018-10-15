<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Image;
use App\Models\Style;
use App\Models\User;
use App\Models\Wheel;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Yajra\Acl\Models\Permission;
use Yajra\Acl\Models\Role;

class DashController extends Controller
{
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
                    User::count()
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Wheels',
                    'circle-thin',
                    'green',
                    route('cp.wheels.index'),
                    Wheel::count()
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Brands',
                    'building-o',
                    'red',
                    route('cp.brands.index'),
                    Brand::count()
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Collections',
                    'object-group',
                    'blue',
                    route('cp.collections.index'),
                    Collection::count()
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Styles',
                    'star-o',
                    'yellow',
                    route('cp.styles.index'),
                    Style::count()
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Images',
                    'image',
                    'gray',
                    'images',
                    Image::count()
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Roles',
                    'unlock-alt',
                    'info',
                    'roles',
                    Role::count()
                )
            );

            $row->column(
                3,
                new InfoBox(
                    'Permissions',
                    'lock',
                    'aqua',
                    'permissions',
                    Permission::count()
                )
            );
        });

        return $content
            ->header('Dashboard')
            ->description('description');
    }
}
