<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use DateTime;
use App\Enums\DoctorType;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'personal_number',
        'name',
        'email',
        'password',
        'date_of_birth',
        'gender',
        'phone_number',
        'type_of_doctor',
        'profile_image'
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
        'password' => 'hashed',
        //'type_of_doctor' => DoctorType::class,
    ];

    public function doctor_appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function patient_appointments() {
        return $this->hasMany(Appointment::class);
    }
    public function reports() {
        return $this->hasMany(Report::class);
    }
    
}
