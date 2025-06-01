<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XpTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'xp_source_id',
        'xp_amount',
        'multiplier_applied',
        'final_xp',
        'source_type',
        'source_id',
        'metadata',
        'reason',
        'is_bonus',
        'earned_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_bonus' => 'boolean',
        'earned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function source()
    {
        return $this->belongsTo(XpSource::class, 'xp_source_id');
    }
}
