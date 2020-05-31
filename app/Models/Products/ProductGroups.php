<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductGroups.php
 * @LastModified 31/05/2020, 03:19
 */

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductGroups extends Model
{
    protected $table = 'product_groups';

    protected $fillable = [
        'product_id', 'group_id', 'created_at', 'updated_at'
    ];
}
