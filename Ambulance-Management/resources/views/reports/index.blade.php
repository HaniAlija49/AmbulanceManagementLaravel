<x-app-layout>
    <section class="container mt-4">
        <h1>List of Reports</h1>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Appointment</th>
                            <th>Doctor</th>
                            <th>Symptoms</th>
                            <th>Diagnoses</th>
                            <th>Prescriptions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->appointment_id }}</td>
                                <td>{{ $report->doctor->name }}</td>
                                <td>{{ $report->symptoms }}</td>
                                <td>{{ $report->diagnoses }}</td>
                                <td>{{ $report->prescriptions }}</td>
                                <td>
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('reports.edit', $report->id) }}" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <form action="{{ route('reports.destroy', $report->id) }}" method="post" class="dropdown-item">
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
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('reports.create') }}" class="btn btn-success">Create</a>
        </div>
    </section>
</x-app-layout>
