<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportableContentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'table_name',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
