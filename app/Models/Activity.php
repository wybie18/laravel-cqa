<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'activity_type_id',
        'title',
        'description',
        'instructions',
        'max_attempts',
        'time_limit',
        'order',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function type()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function typingTest()
    {
        return $this->hasOne(TypingTest::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }
}
