<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_category_id',
        'name',
        'description',
        'requires_evidence',
        'is_active',
    ];

    protected $casts = [
        'requires_evidence' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ReportCategory::class, 'report_category_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
