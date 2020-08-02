<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 * @package App\Models\Config
 */
class Email extends Model
{
    /**
     * @var string
     */
    protected $table = 'config_email';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'created_at', 'updated_at', 'created_by', 'updated_by', 'visibility'
    ];

    /**
     * @param $value
     * @return false|string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * @param $value
     * @return false|string
     */
    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * @param $query
     * @param $param
     * @return mixed
     */
    public function scopeVisibility($query, $param)
    {
        return $query->where('visibility', $param);
    }
}
