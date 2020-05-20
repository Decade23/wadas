<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename main.php
 * @LastModified 25/03/2020, 14:51
 */

Route::group([
    'prefix' => 'main',
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('', 'MainController@index')
        ->name('main.index')->middleware('sentinel.permission:dashboard');

});
