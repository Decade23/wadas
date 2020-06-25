<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $primaryKey = 'code';

    protected $fillable = [
        'code', 'province'
    ];

    public $timestamps = false;
}
