<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'type',
        'attachment',
        'is_pinned',
        'is_active',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the user who created the announcement.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the type display name.
     */
    public function getTypeDisplayAttribute()
    {
        $types = [
            'urgent' => 'Mendesak',
            'important' => 'Penting',
            'general' => 'Umum',
            'event' => 'Kegiatan',
        ];

        return $types[$this->type] ?? $this->type;
    }

    /**
     * Get the type color for display.
     */
    public function getTypeColorAttribute()
    {
        $colors = [
            'urgent' => 'red',
            'important' => 'yellow',
            'general' => 'blue',
            'event' => 'green',
        ];

        return $colors[$this->type] ?? 'gray';
    }

    /**
     * Get the attachment URL if attachment exists.
     */
    public function getAttachmentUrlAttribute()
    {
        if ($this->attachment) {
            return asset('storage/' . $this->attachment);
        }
        return null;
    }

    /**
     * Scope a query to only include active announcements.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include published announcements.
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include pinned announcements.
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Check if announcement is published.
     */
    public function isPublished()
    {
        return $this->published_at && $this->published_at <= now();
    }
}