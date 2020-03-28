<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename users.php
 * @LastModified 26/03/2020, 00:19
 */
Route::group([
    'prefix' => 'users',
//    'middleware' => 'prevent.default.history'
], function () {

    Route::get('', 'UserController@index')
        ->name('user.index');

    Route::get('create', 'UserController@create')
        ->name('user.create');

    Route::post('store', 'UserController@store')
        ->name('user.store');

    Route::get('{id}/show', 'UserController@show')
        ->name('user.show');

    Route::put('{id}/edit', 'UserController@edit')
        ->name('user.edit');

    Route::get('{id}/update', 'UserController@update')
        ->name('user.update');

    Route::delete('{id}/destroy', 'UserController@destroy')
        ->name('user.destroy');

    #update status
    Route::put('{id}/status', 'UserController@status')
        ->name('user.status');

    #bulk destroy
    Route::delete('destroy/bulk', 'UserController@destroyBulk')
        ->name('user.destroy.bulk');

    # for DataTables
    Route::get('ajax/data', 'UserController@datatable')
        ->name('user.ajax.data');

});

