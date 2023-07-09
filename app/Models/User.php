<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nik',
        'email',
        'password',
        'role',
        'type_school_id',
        'grade_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): Attribute
    {
        $options = [
            'name' => $this->name,
            'background' => 'ff6a00',
            'color' => 'fff',
            'size' => 512,
        ];

        return Attribute::make(
            get: fn () => 'https://ui-avatars.com/api/?' . http_build_query($options),
        );
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function personalData()
    {
        return $this->hasOne(PersonalData::class);
    }

    public function typeSchool()
    {
        return $this->belongsTo(TypeSchool::class);
    }

    public function scopeUserNow($query)
    {
        return $query->where('id', auth()->user()->id);
    }
}
