<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'type',
        'criteria',
        'points',
        'is_active',
    ];

    protected $casts = [
        'criteria' => 'array',
        'points' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the users who have earned this achievement.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements')
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }

    /**
     * Get the type display name.
     */
    public function getTypeDisplayAttribute()
    {
        $types = [
            'course_completion' => 'Penyelesaian Kursus',
            'quiz_score' => 'Skor Quiz',
            'streak' => 'Konsistensi',
            'participation' => 'Partisipasi',
            'special' => 'Khusus',
        ];

        return $types[$this->type] ?? $this->type;
    }

    /**
     * Get the icon URL if icon exists.
     */
    public function getIconUrlAttribute()
    {
        if ($this->icon) {
            return asset('storage/' . $this->icon);
        }
        return null;
    }

    /**
     * Scope a query to only include active achievements.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Check if user has earned this achievement.
     */
    public function isEarnedBy($userId)
    {
        return $this->users()->where('user_id', $userId)->exists();
    }

    /**
     * Award this achievement to a user.
     */
    public function awardTo($userId)
    {
        if (!$this->isEarnedBy($userId)) {
            $this->users()->attach($userId, ['earned_at' => now()]);
            return true;
        }
        return false;
    }
}