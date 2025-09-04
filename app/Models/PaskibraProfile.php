<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaskibraProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jabatan',
        'periode',
        'sekolah',
        'alamat',
        'no_hp',
        'parent_contact',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'jenis_kelamin',
        'emergency_contact',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}