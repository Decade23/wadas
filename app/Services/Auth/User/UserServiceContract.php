<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename UserServiceContract.php
 * @LastModified 26/03/2020, 00:24
 */

namespace App\Services\Auth\User;


/**
 * Interface UserServiceContract
 * @package App\Services\Auth\User
 */
interface UserServiceContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id);

    /**
     * @param $request
     * @return mixed
     */
    public function getData($request);

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

}
