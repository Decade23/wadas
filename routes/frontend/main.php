<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename main.php
 * @LastModified 10/05/2020, 11:00
 */


Route::group([
    //'prefix' => 'main',
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('', 'MainController@index')
        ->name('front_main.index');

});
