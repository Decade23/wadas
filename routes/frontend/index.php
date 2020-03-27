<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename index.php
 * @LastModified 24/03/2020, 02:50
 */

Route::group(['prefix' => ''], function() {

    #To find another route files
    $dir = base_path('routes/frontend');

    #Scan file to dir
    $files = scandir($dir);

    foreach ($files as $file) {
        if ( ! in_array($file, array('.', '..', 'index.php') ) ) {
            require $dir . '/' . $file;
        }
    };

});

