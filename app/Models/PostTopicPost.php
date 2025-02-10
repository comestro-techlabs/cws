<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTopicPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_chapter_id',
        'topic_name',
        'order',
        'topic_description',
        'topic_slug',
    ];


    // public function chapter()
    // {
    //     return $this->hasMany(Chapter::class, "id", "chapter_id");
    // }
    public function postChapter()
    {
        return $this->belongsTo(PostChapter::class,'post_chapter_id', 'id');
    }

    public function postMyPosts(){
        return $this->hasMany(PostMyPost::class,'post_topic_post_id', 'id');
    }
}
