<?php

namespace App\Models\Auth;

use App\Models\Subdistricts;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'subdistrict_id',
        'province',
        'postal_code',
    ];

    /**
     * Get Subdistrict
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subdistrict(){
        return $this->belongsTo(Subdistricts::class);
    }

    public function getAddressAttribute($value)
    {

        $value = $value != null ? $value : '';

        return $value;
    }

    public function getSubdistrictIdAttribute($value)
    {

        $value = $value != null ? $value : 0;

        return $value;
    }

    public function getPostalCodeAttribute($value)
    {

        $value = $value != null ? $value : '';

        return $value;
    }

    public function getCreatedAtAttribute($value)
    {

        $value = $value != null ? $value : '';

        return $value;
    }

    public function getUpdatedAtAttribute($value)
    {

        $value = $value != null ? $value : '';

        return $value;
    }
}
