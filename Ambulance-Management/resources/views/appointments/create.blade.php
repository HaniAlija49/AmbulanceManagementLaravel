<x-app-layout>
<section>
    <div>
        <h1>Create Appointment</h1>
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <label for="patient_id">Patient ID</label>
            <br>
            <select name="patient_id">
                {{-- Assuming $patients is an array or collection of patients --}}
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
            <br>

            <label for="doctor_id">Doctor ID</label>
            <br>
            <select name="doctor_id">
                {{-- Assuming $doctors is an array or collection of doctors --}}
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
            <br>

            <label for="appointmentDate">Appointment Date</label>
            <br>
            <input type="date" name="appointmentDate">
            <br>

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

            <br>

            <button type="submit">Create</button>
        </form>
    </div>
</section>
</x-app-layout>
