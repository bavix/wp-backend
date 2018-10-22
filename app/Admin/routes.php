<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'DashController@index')
        ->name('cp.dashboard');

    $router->resource('oauth-client', 'OAuthClientController')
        ->names('cp.oauth');

    $router->resource('brands', 'BrandController')
        ->names('cp.brands');

    $router->resource('collections', 'CollectionController')
        ->names('cp.collections');

    $router->resource('wheels', 'WheelController')
        ->names('cp.wheels');

    $router->resource('styles', 'StyleController')
        ->names('cp.styles');

    $router->resource('users', 'UserController')
        ->names('cp.users');

    $router->resource('roles', 'RoleController')
        ->names('cp.roles');

    $router->resource('permissions', 'PermissionController')
        ->names('cp.permissions');

    // api
    $router->get('api/brands', 'ApiController@brands')
        ->name('cp.api.brands');

    $router->get('api/collections', 'ApiController@collections')
        ->name('cp.api.collections');

});
