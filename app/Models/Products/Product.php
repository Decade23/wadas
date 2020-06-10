<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename Product.php
 * @LastModified 31/05/2020, 03:16
 */

namespace App\Models\Products;

use App\Models\Groups;
use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'type', 'name', 'slug', 'short_desc', 'description', 'time_period', 'start_at', 'end_at', 'price', 'visibility',
        'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function setPriceAttribute($value){
        $this->attributes['price'] = preg_replace('/[^0-9-.]+/', '', $value);
    }

    public function hasManyGroups()
    {
        return $this->hasMany(ProductGroups::class,'id','product_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Groups::class,'product_groups','product_id','group_id')->withTimestamps();
    }

    public function media(){
        return $this->hasMany(Media::class, 'item_id', 'id')->where('model', 'Product');
    }

}
