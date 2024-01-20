<x-app-layout>
<section>
    <form action="{{ route('appointments.update', $appointments->id) }}" method="POST">
        @csrf
        @method('put')

        <label for="patient_id">Patient</label><br>
        <select name="patient_id">
            {{-- Assuming $patients is an array or collection of patients --}}
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" {{ $patient->id == $appointments->patient_id ? 'selected' : '' }}>
                    {{ $patient->name }}
                </option>
            @endforeach
        </select><br>

        <label for="doctor_id">Doctor</label><br>
        <select name="doctor_id">
            {{-- Assuming $doctors is an array or collection of doctors --}}
            @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ $doctor->id == $appointments->doctor_id ? 'selected' : '' }}>
                    {{ $doctor->name }}
                </option>
            @endforeach
        </select><br>

        <label for="appointment_date">Appointment Date</label><br>
        <input type="date" name="appointment_date" value="{{ $appointments->appointmentDate}}"><br>

        <label for="appointmentHour">Appointment Hour</label>
            <br>
            <select id="appointmentHour" name="appointmentHour" class="form-control" required autofocus autocomplete="appointmentHour">
            @foreach (\App\Enums\Hour::cases() as $case)
                <option value="{{ $case }}">
                    {{ $case }}
                </option>
                @endforeach
</select>
<br>

<div class="form-group form-check">
            <input type="hidden" name="isApproved" value="0">
            <input type="checkbox" name="isApproved" class="form-check-input" id="isApproved" value="1">
            <label class="form-check-label" for="isApproved">Is Approved</label>

            </div>

        <button type="submit">Update</button>
    </form>
</section>
</x-app-layout>
