<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename apl.php
 * @LastModified 21/07/2020, 03:06
 */

Route::group([
    'prefix' => 'apl',
    'middleware' => 'prevent.back.history',
    'namespace' => 'Aplikasi'
], function () {

    Route::group([
        'prefix' => 'email',
        'middleware' => 'prevent.back.history'
    ], function () {

        //test route
        Route::get('test/ses',function() {
            return \App\Traits\Email\EmailSesTrait::sendEmailSES();
        })->name('apl_email.ses')->middleware('sentinel.permission:apl_email.show');
        //end test

        Route::get('inbox','AplEmailController@index')
            ->name('apl_email.index')->middleware('sentinel.permission:apl_email.show');

        Route::get('create','AplEmailController@create')
            ->name('apl_email.create')->middleware('sentinel.permission:apl_email.create');

        Route::post('store', 'AplEmailController@store')
            ->name('apl_email.store')->middleware('sentinel.permission:apl_email.create');

        Route::get('{id}/show', 'AplEmailController@show')
            ->name('apl_email.show')->middleware('sentinel.permission:apl_email.show');

        Route::get('{id}/edit', 'AplEmailController@edit')
            ->name('apl_email.edit')->middleware('sentinel.permission:apl_email.edit');

        Route::put('{id}/update', 'AplEmailController@update')
            ->name('apl_email.update')->middleware('sentinel.permission:apl_email.edit');

        Route::delete('{id}/destroy', 'AplEmailController@destroy')
            ->name('apl_email.destroy')->middleware('sentinel.permission:apl_email.destroy');

        #bulk destroy
        Route::delete('destroy/bulk', 'AplEmailController@destroyBulk')
            ->name('apl_email.destroy.bulk')->middleware('sentinel.permission:apl_email.destroy');

        # for DataTables
        Route::get('ajax/data', 'AplEmailController@datatable')
            ->name('apl_email.ajax.data')->middleware('sentinel.permission:apl_email.show');

        # for select2
        Route::get('ajax/select2', 'AplEmailController@select2')
            ->name('apl_email.ajax.select2')->middleware('sentinel.permission:apl_email.show');

        # for tagIfy
        Route::get('ajax/tagify', 'AplEmailController@tagify')
            ->name('apl_email.ajax.tagify')->middleware('sentinel.permission:apl_email.show');

        # for tagIfy Group
        Route::get('ajax/tagify/group', 'AplEmailController@tagifyGroup')
            ->name('apl_email.ajax.tagify_group')->middleware('sentinel.permission:apl_email.show');

        # for select2 email config
        Route::get('ajax/select2/config', 'AplEmailController@select2Config')
            ->name('apl_email.ajax.select2_config')->middleware('sentinel.permission:apl_email.show');

        # for image upload
        Route::post('upload/image', 'AplEmailController@imageUpload')
            ->name('apl_email.upload.image')->middleware('sentinel.permission:apl_email.create');

        # retrieve image create upload
        Route::post('upload/image/create/retrieve', 'AplEmailController@retrieveImageCreateUpload')
            ->name('apl_email.retrieve_create.image')->middleware('sentinel.permission:apl_email.show');

        # delete image upload
        Route::delete('upload/image/delete', 'AplEmailController@deleteImageUpload')
            ->name('apl_email.delete.image')->middleware('sentinel.permission:apl_email.destroy');
    });

});
