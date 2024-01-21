<x-app-layout>
<section>
    <div>
        <h1>Create Report</h1>
        <form action="{{ route('reports.store') }}" method="POST">
            @csrf

            <label for="appointment_id">Appointment ID</label>
            <br>
            <select name="appointment_id">
                @foreach ($appointments as $appointment)
                    <option value="{{ $appointment->id }}">{{ $appointment->id }}</option>
                @endforeach
            </select>
            <br>

            <label for="doctor_id">Doctor ID</label>
            <br>
            <select name="doctor_id">
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
            <br>

            <label for="symptoms">Symptoms</label>
            <br>
            <textarea name="symptoms"></textarea>
            <br>

            <label for="diagnoses">Diagnoses</label>
            <br>
            <textarea name="diagnoses"></textarea>
            <br>

            <label for="prescriptions">Prescriptions</label>
            <br>
            <textarea name="prescriptions"></textarea>
            <br>

            <button type="submit">Create</button>
        </form>
    </div>
</section>
</x-app-layout>
