<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename fulfillments.php
 * @LastModified 21/05/2020, 01:01
 */

Route::group([
    'prefix' => 'config',
    'middleware' => 'prevent.back.history',
    'namespace' => 'Config'
], function () {

    Route::group([
        'prefix' => 'email',
        'middleware' => 'prevent.back.history'
    ], function () {

        Route::get('','EmailController@index')
            ->name('config_email.index')->middleware('sentinel.permission:config_email.show');

        Route::get('create','EmailController@create')
            ->name('config_email.create')->middleware('sentinel.permission:config_email.create');

        Route::post('store', 'EmailController@store')
            ->name('config_email.store')->middleware('sentinel.permission:config_email.create');

        Route::get('{id}/show', 'EmailController@show')
            ->name('config_email.show')->middleware('sentinel.permission:config_email.show');

        Route::get('{id}/edit', 'EmailController@edit')
            ->name('config_email.edit')->middleware('sentinel.permission:config_email.edit');

        Route::put('{id}/update', 'EmailController@update')
            ->name('config_email.update')->middleware('sentinel.permission:config_email.edit');

        Route::delete('{id}/destroy', 'EmailController@destroy')
            ->name('config_email.destroy')->middleware('sentinel.permission:config_email.destroy');

        #bulk destroy
        Route::delete('destroy/bulk', 'EmailController@destroyBulk')
            ->name('config_email.destroy.bulk')->middleware('sentinel.permission:config_email.destroy');

        # for DataTables
        Route::get('ajax/data', 'EmailController@datatable')
            ->name('config_email.ajax.data')->middleware('sentinel.permission:config_email.show');

        # for select2
        Route::get('ajax/select2', 'EmailController@select2')
            ->name('config_email.ajax.select2')->middleware('sentinel.permission:config_email.show');

    });

});


