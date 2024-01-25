<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @php

    @endphp
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                            <div class="dash-widget">
                                <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                        <h3>{{$doctors->count()}}</h3>
                                    <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                            <div class="dash-widget">
                                <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                                <div class="dash-widget-info text-right">
                        <h3>{{$patients->count()}}</h3>
                                    <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                            <div class="dash-widget">
                                <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                        <h3> {{$appointments->count()}}</h3>
                                    <span class="widget-title3">Appointments <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title d-inline-block">Upcoming Appointments</h4> 
                                    <a href="{{ route('appointments.index') }}" class="btn btn-primary float-right">View all</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="d-none">
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Doctor Name</th>
                                                    <th>Doctor type</th>
                                                    <th>Date</th>
                                                    <th>Hour</th>
                                                    <th class="text-right">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($appointments != null)
                                                
                                                    
                                                @foreach ($appointments->take(10) as $appointment)
                                                <tr>
                                                    <td>{{ $appointment->patient->name }}</td>
                                                    <td>{{ $appointment->doctor->name }}</td>
                                                    <td>{{ $appointment->doctor->type_of_doctor }}</td>
                                                    <td>{{ $appointment->appointmentDate }}</td>
                                                    <td>{{ $appointment->appointmentHour }}</td>
                                                    <td>
                                                        @if ($appointment->isApproved)
                                                            <span class="custom-badge status-green">Approved</span>
                                                        @else
                                                            <span class="custom-badge status-red">Not Approved</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="5">No appointment data found.</td>
                                            </tr>
                                            @endif
                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                            <div class="card member-panel">
                                <div class="card-header bg-white">
                                    <h4 class="card-title mb-0">Doctors</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="contact-list">
                                        @if ($doctors != null)
                                        <li>
                                        @foreach ($doctors->take(10) as $doctor)

                                                    <div class="contact-cont p-2 border-b-1">
                                                        <div class="float-left user-img m-r-10 ">
                                                            <a href="profile.html" title="{{$doctor->name}}">
                                                                <img src="{{ $doctor->profile_image ? asset('storage/'. $doctor->profile_image) : asset('img/no-image.jpg') }}" alt="Profile Picture" class="w-40 rounded-circle">
                                                                <span class="status online"></span>
                                                            </a>
                                                        </div>
                                                        <div class="contact-info">
                                                            <span class="contact-name text-ellipsis">{{$doctor->name}}</span>
                                                            <span class="contact-date">{{$doctor->type}}</span>
                                                        </div>
                                                    </div>
                                                
                                            @endforeach
                                            </li>
                                            @else
                                            <tr>
                                                <td >No doctor data found.</td>
                                            </tr>
                                        @endif
                                    </ul>
                                </div>
                                <div class="card-footer text-center bg-white">
                                    <a href ="{{route('profile.index',['type'=>'doctor'])}}" class="text-muted">View all Doctors</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->hasRole('patient'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h3 class="card-title">Medical Reports </h3>
                                    
                                <div class="experience-box">
                                    <table class="table table-border table-striped custom-table datatable mb-0">
                                        <thead>
                                            <tr>
                                                <th>Doctor</th>
                                                <th>Symptoms</th>
                                                <th>Diagnosis</th>
                                                <th>Prescriptions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($reports != null)
                                                @foreach ($reports as $report)
                                                    <tr>
                                                        <td>{{$report->doctor->name}}</td>
                                                        <td>{{$report->symptoms}}</td>
                                                        <td>{{$report->diagnoses}}</td>
                                                        <td>{{$report->prescriptions}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title d-inline-block">New Patients </h4> 
                                    <a href ="{{route('profile.index',['type'=>'patient'])}}"  class="btn btn-primary float-right">View all</a>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table mb-0 new-patient-table">
                                            <tbody>
                                                @if ($patients != null)
                                                
                                                    @foreach ($patients->take(10) as $patient) 
                                                    
                                                        <tr>
                                                            <td>
                                                                <h2>{{$patient->name}}</h2>
                                                            </td>
                                                            <td>{{$patient->email}}</td>
                                                            <td>{{$patient->number}}</td>
                                                        </tr>
                                                    
                                                    @endforeach
                                                @else
                                                
                                                    <tr>
                                                        <td colspan="4">No patient data found.</td>
                                                    </tr>
                                                
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
                    @endif
</x-app-layout>
