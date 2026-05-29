<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'password_hint',
        'profile_picture',
    ];



    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    public function isAdminOrStaff()
    {
        return in_array($this->role, ['admin', 'staff']);
    }

    public function getProfilePictureUrlAttribute()
    {
        if (!$this->profile_picture) {
            return null;
        }

        return Storage::disk('public')->exists($this->profile_picture)
            ? Storage::url($this->profile_picture)
            : null;
    }

    public function getProfileInitialAttribute()
    {
        return strtoupper(substr($this->name ?? '', 0, 1));
    }
}

