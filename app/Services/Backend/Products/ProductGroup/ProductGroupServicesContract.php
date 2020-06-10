<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductGroupServicesContract.php
 * @LastModified 01/06/2020, 11:31
 */

namespace App\Services\Backend\Products\ProductGroup;


/**
 * Interface ProductGroupServicesContract
 * @package App\Services\Backend\Products\ProductGroup
 */
interface ProductGroupServicesContract
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @param int $id
     * @param $request
     * @return mixed
     */
    public function update(int $id, $request);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);

    /**
     * @param array $id
     * @return mixed
     */
    public function destroyBulk(array $id);

    /**
     * @param $request
     * @return mixed
     */
    public function datatable($request);

    /**
     * @param $request
     * @return mixed
     */
    public function select2($request);

    /**
     * @param $request
     * @return mixed
     */
    public function queryProductGroups($request);

    /**
     * @param int $id
     * @return mixed
     */
    public function getGroupById(int $id);

}
