<?php

namespace App\Models\Auth;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'pre_trading',
        'start_at',
        'expired_at',
        'membership_status'
    ];

    /**
     * Get User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }

    /**
     * @param $query
     * @param $userId
     *
     * @return mixed
     */
    public function scopeUser($query, $userId){
        return $query->where('user_id', $userId);
    }
}
