<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Complains extends Model
{
    protected $fillable = [
        'order_id', 'customer_id', 'agent_id', 'order_code', 'solution', 'problem', 'status'
    ];

    /**
     * Get Orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders(){
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function agent(){
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }
}
