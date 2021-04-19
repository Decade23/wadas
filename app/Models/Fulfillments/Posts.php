<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename Posts.php
 * @LastModified 21/05/2020, 01:33
 */

namespace App\Models\Fulfillments;

use App\Models\Auth\User;
use App\Models\Media;
use App\Models\Products\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Posts
 * @package App\Models\Fulfillments
 */
class Posts extends Model
{
    /**
     * @var string
     */
    protected $table = 'cms_posts';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'slug', 'short_content', 'content', 'mobile_content', 'written_by', 'product_id', 'counter',
        'created_at', 'updated_at', 'visibility', 'keywords'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class,'id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'item_id', 'id')->where('model', 'Posts');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'email','written_by');
    }

    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeByVisibility($query, $visibility)
    {
        return $query->where('visibility', $visibility);
    }

    public function getPostDateAttribute()
    {
        return Carbon::parse( $this->created_at )->format('jS M Y, h:i A');
    }
}
