<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename login.php
 * @LastModified 24/03/2020, 03:05
 */

Route::group([
    'prefix' => 'login',
    'middleware' => 'prevent.back.history'
], function(){

    Route::get('', 'LoginController@showLoginForm')
        ->name('login.form');

    Route::post('/process', 'LoginController@login')
        ->name('login.process');
});

Route::group([
    'prefix' => 'logout',
    'middleware' => 'prevent.back.history'
], function(){

    Route::get('', 'LoginController@logout')
        ->name('logout');
});

