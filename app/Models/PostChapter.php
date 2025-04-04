<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostChapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_course_id',
        'chapter_name',
        'chapter_description',
        'chapter_slug',
        'order'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($chapter) {
            $chapter->chapter_slug = Str::slug($chapter->chapter_name);
        });
    }

    public function course()
    {
        return $this->belongsTo(PostCourse::class,'post_course_id');
    }

    public function topics()
    {
        return $this->hasMany(PostTopicPost::class);
    }

   
}
