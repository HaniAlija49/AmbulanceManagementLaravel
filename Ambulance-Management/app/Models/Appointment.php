<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'appointmentDate',
        'appointmentHour',
        'isApproved'
    ];

    public function doctor() {
        return $this->belongsTo(User::class);
    }

    public function patient() {
        return $this->belongsTo(User::class);
    }

    public function report(){
        return $this->hasOne(Report::class);
    }
}
