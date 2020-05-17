<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename RoleServiceContract.php
 * @LastModified 17/05/2020, 15:20
 */

namespace App\Services\Auth\Role;


/**
 * Interface RoleServiceContract
 * @package App\Services\Auth\Role
 */
interface RoleServiceContract
{

    /**
     * @return mixed
     */
    public function getRole();

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

    /**
     * @param int $id
     * @return mixed
     */
    public function status(int $id);

    /**
     * @param $request
     * @return mixed
     */
    public function select2($request);
}
