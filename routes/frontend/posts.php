<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename posts.php
 * @LastModified 11/10/2020, 02:38
 */

Route::group([
    'prefix' => 'blog',
    'middleware' => 'prevent.back.history',
    'namespace' => 'Fulfillments'
], function () {

    Route::get('/{slug}', 'PostsController@show')
        ->name('front_cms_posts.show');

    Route::post('/comment/{slug}/store', 'PostsController@store_comment')
        ->name('front_cms_posts_comments.store');

    Route::post('/comment/get-data-visitor', 'PostsController@get_data_visitor')
        ->name('front_cms_posts_get_data_visitor.show');
});


