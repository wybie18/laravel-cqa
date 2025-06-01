<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XpSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'base_xp',
        'multipliers',
        'is_repeatable',
        'daily_limit',
        'is_active',
    ];

    protected $casts = [
        'multipliers' => 'array',
        'is_repeatable' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function transactions()
    {
        return $this->hasMany(XpTransaction::class);
    }
}
