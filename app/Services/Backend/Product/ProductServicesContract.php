<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductServicesContract.php
 * @LastModified 31/05/2020, 02:28
 */

namespace App\Services\Backend\Product;


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
}
