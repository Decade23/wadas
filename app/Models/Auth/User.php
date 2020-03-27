<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename User.php
 * @LastModified 24/03/2020, 03:30
 */

namespace App\Models\Auth;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models\Auth
 */
class User extends EloquentUser implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'permissions', 'last_login', 'name', 'phone', 'type', 'gender', 'created_by', 'updated_by'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_role() {
        return $this->hasOne(UserRole::class, 'user_id', 'id');
    }
}
