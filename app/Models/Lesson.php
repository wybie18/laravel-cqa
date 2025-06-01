<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'file_url',
        'order',
        'estimated_duration',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)->orderBy('order');
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }
}
