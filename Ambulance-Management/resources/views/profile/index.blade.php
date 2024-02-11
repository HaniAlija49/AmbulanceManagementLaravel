<x-app-layout>
    <section>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

        @if(Auth::user()->hasRole('patient'))
            <div class="section-title">
              <h2>Doctors</h2>
            </div>
    
            <div class="row w-100">
              @foreach ($users as $user)
                  
              
              <div class="col-lg-3 col-md-6 d-flex align-items-start">
                <div class="member card p-2 w-1" data-aos="fade-up" data-aos-delay="100">
                  <div class="member-img">
                    <img src="{{ $user->profile_image ? asset('storage/'.  $user->profile_image) : asset('img/no-image.jpg') }}" class="img-fluid" alt="">
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="member-info">
                    <h4>{{$user->name}}</h4>
                    <span>{{$user->type_of_doctor}}</span>
                  </div>
                </div>
              </div>
    
              @endforeach
            </div>
    
        @else
        <h1>{{$type}}</h1>

        <table class="table table-striped custom-table datatable">
            <thead>
                <tr>
                    <th>Personal Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    @if ($type == 'Doctors')
                    <th>Type of Doctor</th>
                @endif
                   
                    <th>Profile Image</th>
                    @if(Auth::user()->hasRole('admin'))
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href ="{{route('profile.details',['id'=>$user->id])}}>"> {{ $user->personal_number }} </td></a>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->date_of_birth }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->phone_number }}</td>
                        @if ($type == 'Doctors')
                        <td>{{ $user->type_of_doctor }}</td>
                        @endif
                        <td>
                            @if ($user->profile_image)
                                <img src="storage/{{ $user->profile_image }}" alt="Profile Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        @if(Auth::user()->hasRole('admin'))
                        <td>
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form action="{{ route('profile.delete', ['id' => $user->id]) }}" method="post" class="dropdown-item" onsubmit="return confirm('Are you sure you want to delete your profile?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link text-decoration-none"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            @if($type=='Patients')
                <a href="{{ route('registerpatient') }}" class="btn btn-primary">Add Patient</a>
            @else
            <a href="{{ route('register') }}" class="btn btn-primary">Add Employee</a>
            @endif
        </div>
        @endif
    </section>
</x-app-layout>
