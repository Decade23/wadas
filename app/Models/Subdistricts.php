<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subdistricts extends Model
{
    protected $fillable = [
        'rajaongkir_subdistric_id',
        'rajaongkir_city_id',
    ];

    public $timestamps = false;

    public function province(){
        return $this->hasOne(Province::class, 'code', 'province_code');
    }
}
