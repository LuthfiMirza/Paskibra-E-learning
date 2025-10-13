<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'filters',
        'period_start',
        'period_end',
        'created_by',
    ];

    protected $casts = [
        'filters' => 'array',
        'period_start' => 'date',
        'period_end' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
