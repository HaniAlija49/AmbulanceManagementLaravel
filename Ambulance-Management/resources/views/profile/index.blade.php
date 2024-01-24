<x-app-layout>
    <section>
        <h1>{{$type}}</h1>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

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
                    <th>Action</th>
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
    </section>
</x-app-layout>
