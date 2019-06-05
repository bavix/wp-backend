<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')
    ->delete('profile/logout', 'ProfileController@logout')
    ->name('profile.logout');
