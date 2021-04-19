<?php

namespace App\Models\Fulfillments;

use Illuminate\Database\Eloquent\Model;

class CommentPost extends Model
{
    protected $table = 'cms_comments';

    protected $fillable = [
        'id', 'comment_id', 'user_id', 'email', 'name', 'cms_post_id', 'comment', 'status',
        'created_at', 'updated_at'
    ];

    public function posts()
    {
        return $this->hasMany(Posts::class, 'id','cms_post_id');
    }
}
