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

// brands
Route::apiResource('brands', 'BrandsController');

// wheels
Route::apiResource('wheels', 'WheelsController');
Route::get('wheels/{id}/similar', 'WheelsController@similar');
