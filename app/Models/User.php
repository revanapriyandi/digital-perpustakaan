<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'is_admin',
        'profile_photo'
    ];

    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('profile') ?: 'https://ui-avatars.com/api/?name=' . $this->name
            . '&color=7F9CF5&background=EBF4FF';
    }

    public function getProfilePhotoAttribute()
    {
        return $this->getFirstMedia('profile');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'created_by');
    }

    public function getRoleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d F Y H:i:s A', strtotime($value));
    }

    public function getIsAdminAttribute()
    {
        return $this->role === 'Admin';
    }

    public function deleteProfilePhoto()
    {
        $this->clearMediaCollection('profile');
    }
}
