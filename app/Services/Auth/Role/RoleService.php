<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename RoleService.php
 * @LastModified 17/05/2020, 15:21
 */

namespace App\Services\Auth\Role;


use App\Models\Auth\Role;

/**
 * Class RoleService
 * @package App\Services\Auth\Role
 */
class RoleService implements RoleServiceContract
{
    /**
     * @var Role
     */
    protected $model;

    /**
     * RoleService constructor.
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        // TODO: Implement getRole() method.
        return $this->model->select('id', 'name')->get();
    }
}
