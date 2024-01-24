<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    
    public function index()
    {
        $patients = User::whereHas('roles', function ($query) {
            $query->where('name', 'patient');
        })->get();

        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        $appointments = Appointment::all();
        
        return view('dashboard',['appointments'=>$appointments, 'patients' => $patients, 'doctors'=>$doctors]);
    }
}
