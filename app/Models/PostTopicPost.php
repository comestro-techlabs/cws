<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostTopicPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_chapter_id',
        'topic_name',
        'topic_description',
        'topic_slug',
        'order'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($topic) {
            $topic->topic_slug = Str::slug($topic->topic_name);
        });
    }

    public function postChapter()
    {
        return $this->belongsTo(PostChapter::class,'post_chapter_id', 'id');
    }

    public function postMyPosts(){
        return $this->hasMany(PostMyPost::class,'post_topic_post_id', 'id');
    }
}
