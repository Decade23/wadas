<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'item_id', 'type', 'model', 'url', 'path', 'file_name', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
