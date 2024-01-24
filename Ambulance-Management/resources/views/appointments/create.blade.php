<x-app-layout>
    <section class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Create Appointment</h1>

                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="patient_id">Patient ID</label>
                        <select name="patient_id" class="form-control">
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="doctor_id">Doctor ID</label>
                        <select name="doctor_id" class="form-control">
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="appointmentDate">Appointment Date</label>
                        <input type="date" name="appointmentDate" class="form-control">
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
                                <option value="{{ $intValue }}">{{ $formattedTime }}</option>
                            @endforeach
                        </select>
                    </div>
                    
 

                    <div class="mb-3 form-check">
                        <input type="hidden" name="isApproved" value="0">
                        <input type="checkbox" name="isApproved" class="form-check-input" id="isApproved" value="1">
                        <label class="form-check-label" for="isApproved">Is Approved</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>