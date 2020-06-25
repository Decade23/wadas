<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MapServicesContract.php
 * @LastModified 20/06/2020, 01:37
 */

namespace App\Services\Backend\Map;


/**
 * Interface MapServicesContract
 * @package App\Services\Backend\Map
 */
interface MapServicesContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function select2provinces($request);

    /**
     * @param $request
     * @return mixed
     */
    public function select2subdistrict($request);
}
