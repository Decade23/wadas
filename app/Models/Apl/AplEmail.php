<?php

namespace App\Models\Apl;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AplEmail
 * @package App\Models\Apl
 */
class AplEmail extends Model
{
    /**
     * @var string
     */
    protected $table = 'apl_email';

    /**
     * @var array
     */
    protected $fillable = [
        'recipient', 'cc', 'bcc', 'title', 'body', 'created_by', 'updated_by'
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
}
