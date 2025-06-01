<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'achievement_category_id',
        'icon',
        'badge_color',
        'rarity',
        'points',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(AchievementCategory::class, 'achievement_category_id');
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
