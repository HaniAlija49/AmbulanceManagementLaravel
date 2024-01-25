<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testDoctorCanCreateAppointment()
    {
        // Create a doctor role
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'patient']);

        // Create a doctor user with the 'doctor' role
        $doctor = User::factory()->create();
        $doctor->assignRole('doctor');
        $this->actingAs($doctor); // Log in as the doctor user

        // Create a patient user with the 'patient' role
        $patient = User::factory()->create();
        $patient->assignRole('patient');

        // Send a request to create an appointment
        $response = $this->post('/appointments', [
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'appointmentDate' => '2024-01-25', // Replace with a valid date
            'appointmentHour' => '10:00', // Replace with a valid time
            'isApproved' => true,
        ]);

        // Assert that the appointment was created successfully
        $response->assertStatus(302); // Redirect status code
        $response->assertSessionHas('success', 'Appointment created successfully.');

        // Assert that the appointment is stored in the database
        $this->assertDatabaseHas('appointments', [
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'appointmentDate' => '2024-01-25',
            'appointmentHour' => '10:00',
            'isApproved' => true,
        ]);
    }
}
