<?php

namespace App\Enums;

enum DoctorType: string
{
    case NURSE = 'Nurse';
    case CARDIOLOGIST = 'Cardiologist';
    case DERMATOLOGIST = 'Dermatologist';
    case RADIOLOGIST = 'Radiologist';
    case GYNECOLOGIST = 'Gynecologist';
    case PULMONOLOGIST = 'Pulmonologist';
    case ALLERGIST = 'Allergist';
}
?>