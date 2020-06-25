<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename map.php
 * @LastModified 20/06/2020, 01:31
 */

Route::group([
    'middleware' => 'prevent.back.history',
    'prefix'      => 'map'
], function() {

    Route::get('/provinces/ajax/select2', 'MapController@select2provinces')
        ->name('province.ajax.select2')->middleware('sentinel.permission:dashboard');

    Route::get('/subdistricts/ajax/select2', 'MapController@select2subdistrict')
        ->name('subdistrict.ajax.select2')->middleware('sentinel.permission:dashboard');
});
