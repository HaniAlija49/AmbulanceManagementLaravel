<x-app-layout>
    <section>
        <div>
            <h1>Edit Report</h1>
            <form action="{{ route('reports.update', $reports->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="appointment_id">Appointment ID</label>
                <br>
                <select name="appointment_id">
                    @foreach ($appointments as $appointment)
                        <option value="{{ $appointment->id }}" {{ $reports->appointment_id == $appointment->id ? 'selected' : '' }}>
                            {{ $appointment->id }}
                        </option>
                    @endforeach
                </select>
                <br>

                <label for="doctor_id">Doctor ID</label>
                <br>
                <select name="doctor_id">
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $reports->doctor_id == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                <br>

                <label for="symptoms">Symptoms</label>
                <br>
                <textarea name="symptoms">{{ $reports->symptoms }}</textarea>
                <br>

                <label for="diagnoses">Diagnoses</label>
                <br>
                <textarea name="diagnoses">{{ $reports->diagnoses }}</textarea>
                <br>

                <label for="prescriptions">Prescriptions</label>
                <br>
                <textarea name="prescriptions">{{ $reports->prescriptions }}</textarea>
                <br>

                <button type="submit">Update</button>
            </form>
        </div>
    </section>
</x-app-layout>
