<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_id',
        'programming_language_id',
        'code',
        'output',
        'error',
        'execution_time',
        'is_correct',
        'score',
    ];

    protected $casts = [
        'execution_time' => 'integer',
        'is_correct' => 'boolean',
        'score' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function programmingLanguage()
    {
        return $this->belongsTo(ProgrammingLanguage::class);
    }
}
