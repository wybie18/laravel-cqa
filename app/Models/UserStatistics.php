<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courses_created',
        'courses_completed',
        'quizzes_taken',
        'quizzes_passed',
        'coding_exercises_completed',
        'typing_tests_taken',
        'achievement_points',
        'current_streak',
        'longest_streak',
        'last_activity_at',
    ];

    protected $casts = [
        'last_activity_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
