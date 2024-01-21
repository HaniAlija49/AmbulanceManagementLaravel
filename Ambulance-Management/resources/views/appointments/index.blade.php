<x-app-layout>
<section>
    <h1>Appointments</h1>

    @if(session()->has('success'))
        <div>
            <h3>{{ session()->get('success') }}</h3>
        </div>
    @endif

    @foreach ($appointments as $appointment)
        <h3>{{ $appointment->patient->name }}</h3>
        <p>{{ $appointment->description }}</p>
        <p>Doctor: {{ $appointment->doctor->name }}</p>
        <p>Date: {{ $appointment->appointmentDate }}</p>
        <p>Time: {{ $appointment->appointmentHour }}</p>

        @if ($appointment->isApproved)
            <p>Status: <span style="color: green;">Approved</span></p>
        @else
            <p>Status: <span style="color: red;">Not Approved</span></p>
        @endif

        <a href="{{ route('appointments.edit', $appointment->id) }}">Edit</a>

        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
    @endforeach

    <br>

    <a href="{{ route('appointments.create') }}">Create</a>
</section>

</x-app-layout>