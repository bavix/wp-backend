<?php

use Illuminate\Support\Facades\Route;

// auth
Route::post('auth/register', 'AuthController@register')
    ->name('auth.register');

Route::post('auth/forgot', 'AuthController@forgot')
    ->name('auth.forgot');

Route::post('auth/social/{provider}', 'AuthController@social')
    ->name('auth.social');
