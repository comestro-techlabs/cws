<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMyPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_topic_post_id',
        'title',
        'content',
        'image_path',
        'status'
       

    ];

    public function postTopicPost() {
        return $this->belongsTo(PostTopicPost::class);
    }
}
