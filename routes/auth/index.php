<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename index.php
 * @LastModified 24/03/2020, 03:03
 */

#To find another route files
$dir = base_path('routes/auth');

#Scan file to dir
$files = scandir($dir);

foreach ($files as $file) {
    if ( ! in_array($file, array('.', '..', 'index.php') ) ) {
        require $dir . '/' . $file;
    }
};
