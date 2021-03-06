<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename role.php
 * @LastModified 18/05/2020, 02:17
 */

Route::group([
    'prefix' => 'roles',
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('', 'RoleController@index')
        ->name('roles.index')->middleware('sentinel.permission:role.show');

    Route::get('create', 'RoleController@create')
        ->name('roles.create')->middleware('sentinel.permission:role.create');

    Route::post('store', 'RoleController@store')
        ->name('roles.store')->middleware('sentinel.permission:role.create');

    Route::get('{id}/show', 'RoleController@show')
        ->name('roles.show')->middleware('sentinel.permission:role.show');

    Route::get('{id}/edit', 'RoleController@edit')
        ->name('roles.edit')->middleware('sentinel.permission:role.edit');

    Route::put('{id}/update', 'RoleController@update')
        ->name('roles.update')->middleware('sentinel.permission:role.edit');

    Route::delete('{id}/destroy', 'RoleController@destroy')
        ->name('roles.destroy')->middleware('sentinel.permission:role.destroy');

    #update status
    Route::put('{id}/status', 'RoleController@status')
        ->name('roles.status')->middleware('sentinel.permission:role.destroy');

    #bulk destroy
    Route::delete('destroy/bulk', 'RoleController@destroyBulk')
        ->name('roles.destroy.bulk')->middleware('sentinel.permission:role.destroy');

    # for DataTables
    Route::get('ajax/data', 'RoleController@datatable')
        ->name('roles.ajax.data')->middleware('sentinel.permission:role.show');

    # for select2
    Route::get('ajax/select2', 'RoleController@select2')
        ->name('roles.ajax.select2')->middleware('sentinel.permission:role.show');

});
