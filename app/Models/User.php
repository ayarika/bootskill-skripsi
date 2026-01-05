<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
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
        'profile_picture',
        'role',
        'description',
        'social_link',
        'notify_email',
        'notify_app',
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

    protected $appends = ['profile_picture_url'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }

    public function schedules() {

        return $this->hasMany(Schedule::class);
    }

    public function enrolledBootcamps() {
        return $this->hasManyThrough(Bootcamp::class, Enrollment::class, 'user_id', 'id', 'id', 'bootcamp_id');
    }

    public function events() {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile_picture && \Storage::disk('public')->exists($this->profile_picture)) {
            return asset('storage/' . $this->profile_picture);
        }

        return asset('images/default-profile.jpg');
    }


    public function enrolledEvents() {
        return $this->belongsToMany(Event::class, 'enrollments', 'user_id', 'bootcamp_id')
            ->withPivot('payment_proof', 'created_at')
            ->withTimestamps();
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }
}
