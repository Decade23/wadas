<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename UserRole.php
 * @LastModified 24/03/2020, 03:35
 */

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 * @package App\Models\Auth
 */
class UserRole extends Model
{
    /**
     * @var string
     */
    protected $table = 'role_users';

    /**
     * @var array
     */
    protected $fillable = [
        'role_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
