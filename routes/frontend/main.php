<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename main.php
 * @LastModified 10/05/2020, 11:00
 */


Route::group([
    'middleware' => 'prevent.back.history'
], function () {

    Route::get('', function() {
        return redirect()->route('main.index');
    });
});
