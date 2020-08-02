<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailServiceContract.php
 * @LastModified 20/07/2020, 00:40
 */

namespace App\Services\Backend\Config\Email;


/**
 * Interface EmailServiceContract
 * @package App\Services\Backend\Config\Email
 */
interface EmailServiceContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $request
     * @return mixed
     */
    public function datatable($request);

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
     * @param $request
     * @return mixed
     */
    public function queryDatatable($request);

    /**
     * @param $request
     * @return mixed
     */
    public function select2($request);

}
