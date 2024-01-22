<x-app-layout>
    <section>
        <h1>Appointments</h1>

        @if(session()->has('success'))
            <div>
                <h3>{{ session()->get('success') }}</h3>
            </div>
        @endif

        <table class="table table-striped custom-table datatable">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->appointmentDate }}</td>
                        <td>{{ $appointment->appointmentHour }}</td>
                        <td>
                            @if ($appointment->isApproved)
                                <span class="custom-badge status-green">Approved</span>
                            @else
                                <span class="custom-badge status-red">Not Approved</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="post" class="dropdown-item">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link text-decoration-none"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                    </form>

                                    @if ($appointment->isApproved)
                                        <form action="{{ route('appointments.toggleApproval', $appointment->id) }}" method="post" class="dropdown-item">
                                            @csrf
                                            <input type="hidden" name="approve" value="false" />
                                            <button type="submit" class="btn btn-link text-decoration-none"><i class="fa fa-times m-r-5"></i> Disapprove</button>
                                        </form>
                                    @else
                                         <form action="{{ route('appointments.toggleApproval', $appointment->id) }}" method="post" class="dropdown-item">
                                            @csrf
                                            <input type="hidden" name="approve" value="true" />
                                            <button type="submit" class="btn btn-link text-decoration-none"><i class="fa fa-check m-r-5"></i> Approve</button>
                                        </form> 
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create</a>
        </div>
    </section>
</x-app-layout>
