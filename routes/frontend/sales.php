<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename sales.php
 * @LastModified 07/07/2020, 16:19
 */


Route::group([
    'prefix' => 'sales',
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('/{id}/invoice', 'SalesController@invoice')
        ->name('front_sales.index');
});
