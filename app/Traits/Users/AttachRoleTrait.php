<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename AttachRoleTrait.php
 * @LastModified 23/03/2020, 14:53
 */

namespace App\Traits\Users;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


/**
 * Trait AttachRoleTrait
 * @package App\Traits\Users
 */
trait AttachRoleTrait
{
    /**
     * Attach User To Role
     * @param $userDb
     * @param $roleName
     */
    private function attach($userDb, $roleName) {
        $role = Sentinel::findRoleByName($roleName);
        $role->users()->attach($userDb);
    }

}
