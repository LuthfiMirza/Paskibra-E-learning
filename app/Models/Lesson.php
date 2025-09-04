<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'content_type',
        'file_path',
        'order',
        'duration_minutes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duration_minutes' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Get the course that owns the lesson.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the content type display name.
     */
    public function getContentTypeDisplayAttribute()
    {
        $types = [
            'video' => 'Video',
            'pdf' => 'PDF',
            'audio' => 'Audio',
            'text' => 'Teks',
            'interactive' => 'Interaktif',
        ];

        return $types[$this->content_type] ?? $this->content_type;
    }

    /**
     * Scope a query to only include active lessons.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the file URL if file exists.
     */
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }
}