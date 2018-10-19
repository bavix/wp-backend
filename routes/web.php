<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')
    ->name('home.index');

Route::get('/dash', 'DashController@index')
    ->name('dash');

// swagger
Route::middleware('auth')
    ->get('docs', 'SwaggerController@index')
    ->name('swagger');

Route::middleware('auth')
    ->get('docs.json', 'SwaggerController@show')
    ->name('swagger.json');
