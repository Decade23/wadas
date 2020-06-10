<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename products.php
 * @LastModified 31/05/2020, 02:20
 */

Route::group([
    'prefix' => 'product',
    'namespace' => 'Products',
    'middleware' => 'prevent.back.history'
], function () {

    Route::group([
        'prefix' => 'items'
    ], function() {
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

        # for image upload
        Route::post('upload/image', 'ProductController@imageUpload')
            ->name('product.upload.image')->middleware('sentinel.permission:product.create');

        # retrieve image upload
        Route::post('upload/image/retrieve', 'ProductController@retrieveImageUpload')
                ->name('product.retrieve.image')->middleware('sentinel.permission:product.create');

        # delete image upload
        Route::delete('upload/image/delete', 'ProductController@deleteImageUpload')
            ->name('product.delete.image')->middleware('sentinel.permission:product.create');
    });

    Route::group([
        'prefix' => 'groups'
    ], function() {
        Route::get('','ProductGroupController@index')
            ->name('product_group.index')->middleware('sentinel.permission:product_group.show');

        Route::get('create','ProductGroupController@create')
            ->name('product_group.create')->middleware('sentinel.permission:product_group.create');

        Route::post('store', 'ProductGroupController@store')
            ->name('product_group.store')->middleware('sentinel.permission:product_group.create');

        Route::get('{id}/show', 'ProductGroupController@show')
            ->name('product_group.show')->middleware('sentinel.permission:product_group.show');

        Route::get('{id}/edit', 'ProductGroupController@edit')
            ->name('product_group.edit')->middleware('sentinel.permission:product_group.edit');

        Route::put('{id}/update', 'ProductGroupController@update')
            ->name('product_group.update')->middleware('sentinel.permission:product_group.edit');

        Route::delete('{id}/destroy', 'ProductGroupController@destroy')
            ->name('product_group.destroy')->middleware('sentinel.permission:product_group.destroy');

        #bulk destroy
        Route::delete('destroy/bulk', 'ProductGroupController@destroyBulk')
            ->name('product_group.destroy.bulk')->middleware('sentinel.permission:product_group.destroy');

        # for DataTables
        Route::get('ajax/data', 'ProductGroupController@datatable')
            ->name('product_group.ajax.data')->middleware('sentinel.permission:product_group.show');

        # for select2
        Route::get('ajax/select2', 'ProductGroupController@select2')
            ->name('product_group.ajax.select2')->middleware('sentinel.permission:product_group.show');
    });

});

