<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rental_number',
        'phone',
        'province',
        'commune',
        'workplace',
        'job_title',
        'is_active',
        'is_admin',
        'should_show_approval_message',
    ];

    protected static function booted()
    {
        static::updated(function ($user) {
            if ($user->isDirty('is_active') && $user->is_active) {
                $user->should_show_approval_message = true;
                $user->saveQuietly();
            }
        });
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->is_admin;
    }

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
        ];
    }
}
