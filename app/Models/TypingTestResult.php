<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypingTestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'typing_test_id',
        'wpm',
        'accuracy',
        'characters_typed',
        'errors',
        'time_taken',
    ];

    protected $casts = [
        'wpm' => 'integer',
        'accuracy' => 'decimal:2',
        'characters_typed' => 'integer',
        'errors' => 'integer',
        'time_taken' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typingTest()
    {
        return $this->belongsTo(TypingTest::class);
    }
}
