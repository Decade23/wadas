<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename Role.php
 * @LastModified 24/03/2020, 03:48
 */

namespace App\Models\Auth;

use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models\Auth
 */
class Role extends EloquentRole
{
    #protected $dateFormat = 'Y-m-d';

    /**
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'created_by', 'updated_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo('App\Models\SentinelModel\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Models\SentinelModel\User');
    }

}
