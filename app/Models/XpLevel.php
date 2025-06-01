<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XpLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'xp_required',
        'title',
        'description',
        'badge_icon',
        'badge_color',
        'rewards',
        'is_active',
    ];

    protected $casts = [
        'rewards' => 'array',
        'is_active' => 'boolean',
    ];
}
