<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename GroupServicesContract.php
 * @LastModified 01/06/2020, 14:28
 */

namespace App\Services\Backend\Groups;


/**
 * Interface GroupServicesContract
 * @package App\Services\Backend\Groups
 */
interface GroupServicesContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getGroupById(int $id);

    /**
     * @param $type
     * @return mixed
     */
    public function getGroupByType($type);

    /**
     * @param $request
     * @param $type
     * @return mixed
     */
    public function datatableByType($request, $type);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroyGroupById(int $id);


    /**
     * @param $request
     * @param $type
     * @return mixed
     */
    public function select2ByType($request, $type);
}
