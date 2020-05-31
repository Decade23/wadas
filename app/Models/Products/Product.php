<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename Product.php
 * @LastModified 31/05/2020, 03:16
 */

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'type', 'name', 'slug', 'short_desc', 'description', 'time_period', 'start_at', 'end_at', 'price', 'visibility',
        'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

}
