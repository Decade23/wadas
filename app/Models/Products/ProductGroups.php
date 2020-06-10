<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename ProductGroups.php
 * @LastModified 31/05/2020, 03:19
 */

namespace App\Models\Products;

use App\Models\Groups;
use Illuminate\Database\Eloquent\Model;

class ProductGroups extends Model
{
    protected $table = 'product_groups';

    protected $fillable = [
        'product_id', 'group_id', 'created_at', 'updated_at'
    ];

    public function hasProducts()
    {
        return $this->hasOne(Product::class, 'product_id','id');
    }

    public function hasGroup()
    {
        return $this->hasOne(Groups::class,'group_id','id')->where('groups.name','product');
    }
}
