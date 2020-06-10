<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductServicesContract.php
 * @LastModified 01/06/2020, 03:29
 */

namespace App\Services\Backend\Products\Product;


/**
 * Interface ProductServicesContract
 * @package App\Services\Backend\Product
 */
interface ProductServicesContract
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param int $int
     * @return mixed
     */
    public function getById(int $int);

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
    public function queryProducts($request);
}
