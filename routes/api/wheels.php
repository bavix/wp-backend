<?php

use Illuminate\Support\Facades\Route;

// wheels
Route::apiResource('wheels', 'WheelsController');
Route::get('wheels/{id}/similar', 'WheelsController@similar')
    ->name('wheels.similar');

Route::get('wheels/{id}/comments', 'WheelsController@comments')
    ->name('wheels.comments');

Route::post('wheels/{id}/comments', 'WheelsController@storeComment')
    ->name('wheels.storeComment');

Route::middleware('auth:api')
    ->post('wheels/{id}/favorite', 'WheelsController@favorite')
    ->name('wheels.favorite');

Route::middleware('auth:api')
    ->delete('wheels/{id}/favorite', 'WheelsController@unfavorite')
    ->name('wheels.unfavorite');

Route::middleware('auth:api')
    ->post('wheels/{id}/like', 'WheelsController@like')
    ->name('wheels.like');

Route::middleware('auth:api')
    ->delete('wheels/{id}/like', 'WheelsController@unlike')
    ->name('wheels.unlike');
