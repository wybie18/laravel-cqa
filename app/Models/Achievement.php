<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'achievement_type_id',
        'title',
        'description',
        'requirements',
        'target_value',
        'is_repeatable',
        'max_level',
    ];

    protected $casts = [
        'requirements' => 'array',
        'is_repeatable' => 'boolean',
    ];

    public function type()
    {
        return $this->belongsTo(AchievementType::class, 'achievement_type_id');
    }

    public function userAchievements()
    {
        return $this->hasMany(UserAchievement::class);
    }

    public function achievementProgress()
    {
        return $this->hasMany(AchievementProgress::class);
    }
}
