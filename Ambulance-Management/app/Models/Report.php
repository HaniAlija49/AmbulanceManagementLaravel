<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'doctor_id',
        'symptoms',
        'diagnoses',
        'prescriptions'
    ];
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function doctor(){
        return $this->belongsTo(User::class);
    }
 
}
