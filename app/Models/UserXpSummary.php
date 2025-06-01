<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserXpSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'daily_xp',
        'total_xp_end_of_day',
        'xp_breakdown',
    ];

    protected $casts = [
        'date' => 'date',
        'xp_breakdown' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
