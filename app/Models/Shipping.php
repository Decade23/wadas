<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected  $table  = 'shipping';

    protected $fillable = [
        'id', 'tracking_code', 'user_id', 'product_id', 'order_id', 'charge', 'provider', 'created_at', 'updated_at'
    ];

    public function order(){
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }
}
