<?php

Route::group([
    'prefix' => 'sales',
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('', 'SalesController@index')
        ->name('sales.index')->middleware('sentinel.permission:sales.show');

    Route::get('/create', 'SalesController@create')
        ->name('sales.create')->middleware('sentinel.permission:sales.create');

    Route::post('', 'SalesController@store')
        ->name('sales.store')->middleware('sentinel.permission:sales.create');

    Route::get('/{id}/show', 'SalesController@show')
        ->name('sales.show')->middleware('sentinel.permission:sales.show');

    Route::get('/{id}/edit', 'SalesController@edit')
        ->name('sales.edit')->middleware('sentinel.permission:sales.edit');

    Route::put('/{id}', 'SalesController@update')
        ->name('sales.update')->middleware('sentinel.permission:sales.edit');

    Route::delete('/{id}', 'SalesController@destroy')
        ->name('sales.destroy')->middleware('sentinel.permission:sales.destroy');

    # for image upload
    Route::post('upload/image', 'SalesController@imageUpload')
        ->name('sales.upload.image')->middleware('sentinel.permission:sales.create');

    # retrieve image create upload
    Route::post('upload/image/create/retrieve', 'SalesController@retrieveImageCreateUpload')
        ->name('sales.retrieve_create.image')->middleware('sentinel.permission:sales.show');

    # delete image upload
    Route::delete('upload/image/delete', 'SalesController@deleteImageUpload')
        ->name('sales.delete.image')->middleware('sentinel.permission:sales.destroy');

    // For Datatables
    Route::get('/ajax/data', 'SalesController@datatable')
        ->name('sales.ajax.data')->middleware('sentinel.permission:sales.show');

    // For Bulk Update
    Route::delete('/bulk/delete', 'SalesController@bulkDestroy')
        ->name('sales.destroy.bulk')->middleware('sentinel.permission:sales.destroy');

    Route::get('/ajax/select2', 'SalesController@select2')
        ->name('sales.ajax.select2')->middleware('sentinel.permission:sales.show');

    Route::get('/seller/ajax/select2', 'SalesController@seller_select2')
        ->name('sales.seller.ajax.select2')->middleware('sentinel.permission:sales.show');

    Route::get('/{id}/pdf', 'SalesController@pdf')
        ->name('sales.pdf')->middleware('sentinel.permission:sales.show');

});
