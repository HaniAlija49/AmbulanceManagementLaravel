<x-app-layout>
    <section class="container mt-4">
        <form action="{{ route('appointments.update', $appointments->id) }}" method="POST">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="patient_id" class="form-label">Patient</label>
                <select name="patient_id" class="form-control">
                    {{-- Assuming $patients is an array or collection of patients --}}
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $patient->id == $appointments->patient_id ? 'selected' : '' }}>
                            {{ $patient->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="doctor_id" class="form-label">Doctor</label>
                <select name="doctor_id" class="form-control">
                    {{-- Assuming $doctors is an array or collection of doctors --}}
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $doctor->id == $appointments->doctor_id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="appointmentDate" class="form-label">Appointment Date</label>
                <input type="date" name="appointmentDate" value="{{ $appointments->appointmentDate }}" class="form-control">
            </div>

            <div class="form-group">
                        <label for="appointmentHour" class="form-label">Appointment Hour</label>
                        <select id="appointmentHour" name="appointmentHour" class="form-control" required autofocus autocomplete="appointmentHour">
                            @foreach (\App\Enums\Hour::cases() as $case)
                                @php
                                    // Access the actual integer value
                                    $intValue = $case->value;
                                    // Remove the last two zeros from the end
                                    $stringValue = substr_replace((string)$intValue, '', -2);
                                    // Format the time as HH:MM
                                    $formattedTime = substr($stringValue, 0, -2) . ':' . substr($stringValue, -2);
                                @endphp
                                <option value="{{ $intValue }}" {{ $appointments->appointmentHour == $case ? 'selected' : '' }}>
                                    {{ $formattedTime }}
                                </option>
                            @endforeach
                        </select>
                    </div>

            <div class="mb-3 form-check">
                <input type="hidden" name="isApproved" value="0">
                <input type="checkbox" name="isApproved" class="form-check-input" id="isApproved" value="1">
                <label class="form-check-label" for="isApproved">Is Approved</label>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</x-app-layout>

