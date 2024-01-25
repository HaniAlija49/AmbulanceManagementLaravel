<x-app-layout>

        <h2 class="mb-4">User Details</h2>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{ $user->profile_image ? asset('storage/'.  $user->profile_image) : asset('img/no-image.jpg') }}" alt="Profile Picture" class="img-thumbnail" width="300px" />
                    </div>
            
                    <div class="col-sm-9">
                        <dl class="row">
                            <dt class="col-sm-3">Id</dt>
                            <dd class="col-sm-9">{{ $user->id }}</dd>
            
                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">{{ $user->name }}</dd>
            
                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9">{{ $user->email }}</dd>
            
                            <dt class="col-sm-3">Date of Birth</dt>
                            <dd class="col-sm-9">{{ $user->date_of_birth }}</dd>
            
                            <dt class="col-sm-3">Gender</dt>
                            <dd class="col-sm-9">{{ $user->gender }}</dd>
            
                            @if($user->role == 'doctor')
                                <dt class="col-sm-3">Doctor Type</dt>
                                <dd class="col-sm-9">{{ $user->type_of_doctor }}</dd>
                            @endif
            
                            <dt class="col-sm-3">Phone number</dt>
                            <dd class="col-sm-9">{{ $user->phone_number }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            
        </div>
        @if($user->hasRole('patient'))
        <div class="profile-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Reports</a></li>
            </ul>
        
            <div class="tab-content">
                <div class="tab-pane show active" id="about-cont">
        
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
                </div>
            </div>
        </div>
        @endif
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-rounded"><i class="fa fa-arrow-left"></i> Back to List</a>
        </div>

</x-app-layout>