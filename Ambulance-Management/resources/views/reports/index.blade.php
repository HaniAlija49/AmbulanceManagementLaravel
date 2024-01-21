<x-app-layout>
<section>
    <h1>Report</h1>

    @if(session()->has('success'))
        <div>
            <h3>{{ session()->get('success') }}</h3>
        </div>
    @endif

    @foreach ($reports as $report)
        <h3>Appointment ID: {{ $report->appointment_id }}</h3>
        <h3>Doctor ID: {{ $report->doctor_id }}</h3>
        <p>Symptoms: {{ $report->symptoms }}</p>
        <p>Diagnoses: {{ $report->diagnoses }}</p>
        <p>Prescriptions: {{ $report->prescriptions }}</p>
        <a href="{{route('reports.edit', $report->id) }}">Edit</a>

        <form action="{{route('reports.destroy', $report->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
    @endforeach

    <br>

    <a href=" {{ route('reports.create') }}">Create</a>
</section>
</x-app-layout>
