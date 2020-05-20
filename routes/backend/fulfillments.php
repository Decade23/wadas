<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename fulfillments.php
 * @LastModified 21/05/2020, 01:01
 */

Route::group([
    'prefix' => 'fulfillments',
    'middleware' => 'prevent.back.history',
    'namespace' => 'Fulfillments'
], function () {

    Route::group([
        'prefix' => 'posts',
        'middleware' => 'prevent.back.history'
    ], function () {

        Route::get('','PostsController@index')
            ->name('posts.index')->middleware('sentinel.permission:post.show');

        Route::get('create','PostsController@create')
            ->name('posts.create')->middleware('sentinel.permission:post.create');

        Route::post('store', 'PostsController@store')
            ->name('posts.store')->middleware('sentinel.permission:post.create');

        Route::get('{id}/show', 'PostsController@show')
            ->name('posts.show')->middleware('sentinel.permission:post.show');

        Route::get('{id}/edit', 'PostsController@edit')
            ->name('posts.edit')->middleware('sentinel.permission:post.edit');

        Route::put('{id}/update', 'PostsController@update')
            ->name('posts.update')->middleware('sentinel.permission:post.edit');

        Route::delete('{id}/destroy', 'PostsController@destroy')
            ->name('posts.destroy')->middleware('sentinel.permission:post.destroy');

        #bulk destroy
        Route::delete('destroy/bulk', 'PostsController@destroyBulk')
            ->name('posts.destroy.bulk')->middleware('sentinel.permission:post.destroy');

        # for DataTables
        Route::get('ajax/data', 'PostsController@datatable')
            ->name('posts.ajax.data')->middleware('sentinel.permission:post.show');

        # for select2
        Route::get('ajax/select2', 'PostsController@select2')
            ->name('posts.ajax.select2')->middleware('sentinel.permission:post.show');

    });

});


