<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename products.php
 * @LastModified 31/05/2020, 02:20
 */

Route::group([
    'prefix' => 'products',
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('','ProductController@index')
        ->name('product.index')->middleware('sentinel.permission:product.show');

    Route::get('create','ProductController@create')
        ->name('product.create')->middleware('sentinel.permission:product.create');

    Route::post('store', 'ProductController@store')
        ->name('product.store')->middleware('sentinel.permission:product.create');

    Route::get('{id}/show', 'ProductController@show')
        ->name('product.show')->middleware('sentinel.permission:product.show');

    Route::get('{id}/edit', 'ProductController@edit')
        ->name('product.edit')->middleware('sentinel.permission:product.edit');

    Route::put('{id}/update', 'ProductController@update')
        ->name('product.update')->middleware('sentinel.permission:product.edit');

    Route::delete('{id}/destroy', 'ProductController@destroy')
        ->name('product.destroy')->middleware('sentinel.permission:product.destroy');

    #bulk destroy
    Route::delete('destroy/bulk', 'ProductController@destroyBulk')
        ->name('product.destroy.bulk')->middleware('sentinel.permission:product.destroy');

    # for DataTables
    Route::get('ajax/data', 'ProductController@datatable')
        ->name('product.ajax.data')->middleware('sentinel.permission:product.show');

    # for select2
    Route::get('ajax/select2', 'ProductController@select2')
        ->name('product.ajax.select2')->middleware('sentinel.permission:product.show');

});

