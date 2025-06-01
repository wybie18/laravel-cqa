<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'achievement_id',
        'progress_data',
        'current_value',
        'last_updated_at',
    ];

    protected $casts = [
        'progress_data' => 'array',
        'last_updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function achievement()
    {
        return $this->belongsTo(Achievement::class);
    }
}
