<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'DashController@index')
        ->name('cpold.dashboard');

    $router->resource('oauth-client', 'OAuthClientController')
        ->names('cpold.oauth');

    $router->resource('brands', 'BrandController')
        ->names('cpold.brands');

    $router->resource('collections', 'CollectionController')
        ->names('cpold.collections');

    $router->resource('wheels', 'WheelController')
        ->names('cpold.wheels');

    $router->resource('styles', 'StyleController')
        ->names('cpold.styles');

    $router->resource('users', 'UserController')
        ->names('cpold.users');

    $router->resource('roles', 'RoleController')
        ->names('cpold.roles');

    $router->resource('permissions', 'PermissionController')
        ->names('cpold.permissions');

    // api
    $router->get('api/brands', 'ApiController@brands')
        ->name('cpold.api.brands');

    $router->get('api/collections', 'ApiController@collections')
        ->name('cpold.api.collections');

});
