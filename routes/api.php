<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;

// auth
Route::post('auth/register', 'AuthController@register')
    ->name('auth.register');

Route::post('auth/forgot', 'AuthController@forgot')
    ->name('auth.forgot');

Route::post('auth/social/{provider}', 'AuthController@social')
    ->name('auth.social');

// profile
Route::middleware('auth:api')
    ->get('profile', 'ProfileController@show')
    ->name('profile');

Route::middleware('auth:api')
    ->post('profile/verified-email', 'ProfileController@verifiedEmail')
    ->name('auth.verified_email');

Route::middleware('auth:api')
    ->post('profile/change-password', 'ProfileController@changePassword')
    ->name('profile.change_password');

// brands
Route::apiResource('brands', 'BrandsController');

// wheels
Route::apiResource('wheels', 'WheelsController');
Route::get('wheels/{id}/similar', 'WheelsController@similar')
    ->name('wheels.similar');
