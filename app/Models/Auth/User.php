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
use Illuminate\Support\Carbon;

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
        'email', 'password', 'permissions', 'last_login', 'name', 'phone', 'type', 'gender', 'dob', 'recent_company', 'industry', 'created_by', 'updated_by'
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

    public function address(){
        return $this->hasOne(UserAddress::class)->withDefault(function($user) {
            // $userDb = new UserAddress();
            $user->id = 0;
            $user->user_id = 0;
            $user->address = '';
            $user->subdistrict_id = 0;
            $user->province = '';
            $user->postal_code = '';
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();

        });
    }

    public function scopeType($query, $param)
    {
        return $query->where('type', $param);
    }

    public function scopeRole($query, $param)
    {
        return $query->roles[0]->slug = $param;
    }

    public function scopeActivation($query, $param)
    {
        //return $query->where('type', $param);
    }
}
