<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    
    public function index()
    {
        $user = Auth::user();
        $patients = User::whereHas('roles', function ($query) {
            $query->where('name', 'patient');
        })->get();

        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        $reports = Report::whereHas('appointment', function ($query) use ($user) {
            $query->where('patient_id', $user->id)->whereNotNull('patient_id');})->get();
        if($user->hasRole('patient')){
            $appointments = Appointment::where('patient_id', $user->id)->whereNotNull('patient_id')->get();
        }
        else{
        $appointments = Appointment::all();
        }
        
        return view('dashboard',['appointments'=>$appointments, 'patients' => $patients, 'doctors'=>$doctors,'reports'=>$reports]);
    }
}
