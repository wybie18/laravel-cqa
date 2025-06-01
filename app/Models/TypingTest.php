<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypingTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'text_content',
        'time_limit',
        'difficulty',
    ];

    protected $casts = [
        'time_limit' => 'integer',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function results()
    {
        return $this->hasMany(TypingTestResult::class);
    }
}
