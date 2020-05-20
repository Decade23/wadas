<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename Posts.php
 * @LastModified 21/05/2020, 01:33
 */

namespace App\Models\Fulfillments;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'cms_posts';

    protected $fillable = [
        'name', 'slug', 'short_content', 'content', 'mobile_content', 'written_by', 'product_id', 'counter',
        'created_at', 'updated_at'
    ];
}
