<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostChapter extends Model
{
    use HasFactory;
    public function courses()
    {
        return $this->belongsTo(PostCourse::class);
    }

    protected $fillable = [
        'post_course_id',
        'chapter_name',
        'chapter_description',
        'chapter_slug',
        'order'

    ];

    // public function course()
    // {
    //     return $this->hasMany(Course::class, "id", "course_id");
    // }
    public function postCourse() 
    {
        return $this->belongsTo(PostCourse::class, 'post_course_id', 'id');
    }

    public function postTopicPosts()
    {
        return $this->hasMany(PostTopicPost::class, 'post_chapter_id', 'id');
    }
}
