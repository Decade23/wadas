<?php

Route::group([
    'prefix' => 'main',
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('', 'MainController@index')
        ->name('main.index')->middleware('sentinel.permission:dashboard');

});
