<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'role',
        'status',
        'nis',
        'angkatan',
        'avatar',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'angkatan' => 'integer',
        ];
    }

    /**
     * Get the user's PASKIBRA profile.
     */
    public function paskibraProfile()
    {
        return $this->hasOne(PaskibraProfile::class);
    }

    /**
     * Get the courses created by this user.
     */
    public function createdCourses()
    {
        return $this->hasMany(Course::class, 'created_by');
    }

    /**
     * Get the quiz attempts by this user.
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Get the announcements created by this user.
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'created_by');
    }

    /**
     * Get the achievements earned by this user.
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is instructor
     */
    public function isInstructor()
    {
        return $this->role === 'instructor';
    }

    /**
     * Check if user is student
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Check if user is member (for backward compatibility)
     */
    public function isMember()
    {
        return $this->role === 'student';
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayName()
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'instructor' => 'Instruktur',
            'student' => 'Siswa',
            default => 'Unknown'
        };
    }

    /**
     * Check if user is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Scope for admin users
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope for instructor users
     */
    public function scopeInstructors($query)
    {
        return $query->where('role', 'instructor');
    }

    /**
     * Scope for student users
     */
    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }

    /**
     * Scope for active users
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}