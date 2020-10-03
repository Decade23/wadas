<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename MainServiceContract.php
 * @LastModified 25/03/2020, 00:08
 */

namespace App\Services\Main;


/**
 * Interface MainServiceContract
 * @package App\Services\Main
 */
interface MainServiceContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function anyData($request);

    /**
     * @return mixed
     */
    public function blog();

    /**
     * @return mixed
     */
    public function news();

}
