<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename users.php
 * @LastModified 26/03/2020, 00:19
 */
Route::group([
    'prefix' => 'users',
'middleware' => 'prevent.back.history'
], function () {

    Route::get('', 'UserController@index')
        ->name('user.index')->middleware('sentinel.permission:user.show');

    Route::get('create', 'UserController@create')
        ->name('user.create')->middleware('sentinel.permission:user.create');

    Route::post('store', 'UserController@store')
        ->name('user.store')->middleware('sentinel.permission:user.create');

    Route::get('{id}/show', 'UserController@show')
        ->name('user.show')->middleware('sentinel.permission:user.show');

    Route::get('{id}/edit', 'UserController@edit')
        ->name('user.edit')->middleware('sentinel.permission:user.edit');

    Route::put('{id}/update', 'UserController@update')
        ->name('user.update')->middleware('sentinel.permission:user.edit');

    Route::delete('{id}/destroy', 'UserController@destroy')
        ->name('user.destroy')->middleware('sentinel.permission:user.destroy');

    #update status
    Route::put('{id}/status', 'UserController@status')
        ->name('user.status')->middleware('sentinel.permission:user.destroy');

    #bulk destroy
    Route::delete('destroy/bulk', 'UserController@destroyBulk')
        ->name('user.destroy.bulk')->middleware('sentinel.permission:user.destroy');

    # for DataTables
    Route::get('ajax/data', 'UserController@datatable')
        ->name('user.ajax.data')->middleware('sentinel.permission:user.show');

    # for select2
    Route::get('ajax/select2', 'UserController@select2')
        ->name('user.ajax.select2')->middleware('sentinel.permission:user.show');

});

