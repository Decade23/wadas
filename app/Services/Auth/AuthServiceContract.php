<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename AuthServiceContract.php
 * @LastModified 24/03/2020, 23:26
 */

namespace App\Services\Auth;


interface AuthServiceContract
{

    public function login($request);

    public function logout();

}
