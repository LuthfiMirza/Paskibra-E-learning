<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'difficulty',
        'thumbnail',
        'is_active',
        'duration_minutes',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duration_minutes' => 'integer',
    ];

    /**
     * Get the user who created the course.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the lessons for the course.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    /**
     * Get the quizzes for the course.
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Get the category display name.
     */
    public function getCategoryDisplayAttribute()
    {
        $categories = [
            'kepaskibraan' => 'Dasar Kepaskibraan',
            'baris_berbaris' => 'Baris Berbaris',
            'wawasan' => 'Pengetahuan Umum',
            'kepemimpinan' => 'Kepemimpinan',
            'protokoler' => 'Protokoler',
        ];

        return $categories[$this->category] ?? $this->category;
    }

    /**
     * Get the difficulty display name.
     */
    public function getDifficultyDisplayAttribute()
    {
        $difficulties = [
            'umum' => 'Umum',
            'calon_paskibra' => 'Calon Paskibra',
            'wiramuda' => 'Wiramuda',
            'wiratama' => 'Wiratama',
            'instruktur_muda' => 'Instruktur Muda',
            'instruktur' => 'Instruktur',
        ];

        return $difficulties[$this->difficulty] ?? $this->difficulty;
    }

    /**
     * Scope a query to only include active courses.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
