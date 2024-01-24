<x-app-layout>
    <section class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Create Report</h1>

                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf

                    @if(isset($appointment))
                    <div class="form-group">
                        <label for="appointment_id">Appointment ID</label>
                        <select name="appointment_id" class="form-control" disabled> 
                                <option  value="{{ $appointment->id }}" selected>{{ $appointment->id }}</option>
                        </select>
                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                    </div>

                    <div class="form-group">
                        <label for="doctor_id">Doctor ID</label>
                        <select name="doctor_id" class="form-control" disabled>
                                <option  value="{{ $doctor->id }}" selected>{{ $doctor->name }}</option>
                        </select>
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                    </div>

                    @else

                    <div class="form-group">
                        <label for="appointment_id">Appointment ID</label>
                        <select name="appointment_id" class="form-control">
                            @foreach ($appointments as $appointment)
                                <option value="{{ $appointment->id }}">{{ $appointment->id }}</option>
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

                    @endif
                    
                    <div class="form-group">
                        <label for="symptoms">Symptoms</label>
                        <textarea name="symptoms" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="diagnoses">Diagnoses</label>
                        <textarea name="diagnoses" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="prescriptions">Prescriptions</label>
                        <textarea name="prescriptions" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
