<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        return view('reports.index',['reports'=>$reports]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointments = Appointment::all();
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        return view('reports.create', ['appointments' => $appointments, 'doctors'=>$doctors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Report::create([
            'appointment_id'=>$request->input('appointment_id'),
            'doctor_id'=>$request->input('doctor_id'),
            'symptoms'=>$request->input('symptoms'),
            'diagnoses'=>$request->input('diagnoses'),
            'prescriptions'=>$request->input('prescriptions')
        ]);
        return redirect('/reports');
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
        $appointments = Appointment::all();
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        $reports = Report::find($id);
        return view('reports.edit',['reports'=>$reports,'appointments' => $appointments, 'doctors'=>$doctors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reports = Report::find($id);

        $reports->update($request->all());

        return redirect()->route('reports.index')
          ->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reports = Report::find($id);

        $reports->delete();

        return redirect()->route('reports.index')
          ->with('success', 'Report delete successfully.');
    }
}
