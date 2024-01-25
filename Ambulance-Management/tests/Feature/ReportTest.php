<?php
use Tests\TestCase;
use App\Models\User;
use App\Models\Report;
use App\Models\Appointment;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();

        // Create roles during setup
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'patient']);
    }
    public function testDoctorCanCreateReport()
    {
        // Assuming you have a user with a 'doctor' role
        $doctor = User::factory()->create();
        $doctor->assignRole('doctor');

        // Create a fake patient user
        $patient = User::factory()->create();
        $patient->assignRole('patient');

        // Login the doctor
        $this->actingAs($doctor);

        // Create an appointment
        $appointment = Appointment::create([
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id, // Use the patient's id
            'appointmentDate' => now()->toDate(),
            'appointmentHour' => '10:00',
            'isApproved' => true,
        ]);

        // Make a POST request to store the report
        $response = $this->post('/reports', [
            'appointment_id' => $appointment->id,
            'doctor_id' => $doctor->id,
            'symptoms' => 'Test symptoms',
            'diagnoses' => 'Test diagnoses',
            'prescriptions' => 'Test prescriptions',
        ]);

        // Assert that the report was successfully created
        $response->assertRedirect('/reports');
        $this->assertDatabaseHas('reports', [
            'appointment_id' => $appointment->id,
            'doctor_id' => $doctor->id,
            'symptoms' => 'Test symptoms',
            'diagnoses' => 'Test diagnoses',
            'prescriptions' => 'Test prescriptions',
        ]);
    }
}
