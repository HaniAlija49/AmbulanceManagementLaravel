<x-app-layout>
    <section class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Edit Report</h1>
                
                <form action="{{ route('reports.update', $reports->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="appointment_id">Appointment ID</label>
                        <select name="appointment_id" class="form-control">
                            @foreach ($appointments as $appointment)
                                <option value="{{ $appointment->id }}" {{ $reports->appointment_id == $appointment->id ? 'selected' : '' }}>
                                    {{ $appointment->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="doctor_id">Doctor ID</label>
                        <select name="doctor_id" class="form-control">
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $reports->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="symptoms">Symptoms</label>
                        <textarea name="symptoms" class="form-control">{{ $reports->symptoms }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="diagnoses">Diagnoses</label>
                        <textarea name="diagnoses" class="form-control">{{ $reports->diagnoses }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="prescriptions">Prescriptions</label>
                        <textarea name="prescriptions" class="form-control">{{ $reports->prescriptions }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
