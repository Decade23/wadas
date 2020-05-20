<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename changePassword.php
 * @LastModified 20/05/2020, 23:27
 */

Route::group([
    'prefix' => 'password',
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('', 'ChangePasswordController@edit')
        ->name('password.edit')->middleware('sentinel.permission:dashboard');

    Route::put('update', 'ChangePasswordController@update')
        ->name('password.update')->middleware('sentinel.permission:dashboard');


});



