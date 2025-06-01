<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'title',
        'description',
        'is_public',
        'passing_score',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }
}
