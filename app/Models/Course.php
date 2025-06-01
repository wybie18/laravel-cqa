<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_type_id',
        'course_level_id',
        'title',
        'description',
        'image_url',
        'is_published',
        'is_public',
        'estimated_duration',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(CourseType::class, 'course_type_id');
    }

    public function level()
    {
        return $this->belongsTo(CourseLevel::class, 'course_level_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
