<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $appointments = Appointment::all();
       return view('appointments.index', ['appointments' => $appointments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = User::whereHas('roles', function ($query) {
            $query->where('name', 'patient');
        })->get();
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        return view('appointments.create', ['patients' => $patients,'doctors'=>$doctors]);
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
     {
         $isApproved = $request->has('isApproved') && $request->input('isApproved') == true;
     
         Appointment::create([
             'doctor_id'       => $request->input('doctor_id'),
             'patient_id'      => $request->input('patient_id'),
             'appointmentDate' => $request->input('appointmentDate'),
             'appointmentHour' => $request->input('appointmentHour'),
             'isApproved'      => $isApproved,
         ]);
     
         return redirect('/appointments')->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        
        $patients = User::whereHas('roles', function ($query) {
            $query->where('name', 'patient');
        })->get();
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        $appointments = Appointment::find($id);
        return view('appointments.edit',['appointments'=>$appointments, 'patients' => $patients,'doctors'=>$doctors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appointments = Appointment::find($id);

        $appointments->update($request->all());

        return redirect()->route('appointments.index')
          ->with('success', 'Appointment updated successfully.')->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointments = Appointment::find($id);

        $appointments->delete();

        return redirect()->route('appointments.index')
          ->with('success', 'Appointment deleted successfully.')->with('success', 'Appointment deleted successfully.');

    }
    public function toggleApproval(Request $request, Appointment $appointment)
    {
        $approve = $request->input('approve', true);

        $appointment->update([
            'isApproved' => $approve,
        ]);

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }
}
