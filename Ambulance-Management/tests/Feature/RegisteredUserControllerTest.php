<?php

namespace Tests\Feature\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class RegisteredUserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        // Create roles during setup
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'patient']);
    }

    public function test_registration_form_is_displayed()
    {
        // Create a user and authenticate them
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('register'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function test_patient_registration_form_is_displayed()
    {
        // Create a user and authenticate them
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('registerpatient'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.register-patient');
    }

    public function test_user_can_register_as_patient()
    {
        // Create a user and authenticate them
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('public');

        $userData = [
            'personal_number' => $this->faker->unique()->numberBetween(1000000000000, 9999999999999),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'date_of_birth' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone_number' => $this->faker->numerify('#########'),
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect();

        $user = User::where('email', $userData['email'])->first();
        $this->assertNotNull($user);

        // Check if the user has the 'admin' role
        $this->assertTrue($user->hasRole('patient'));

        Storage::disk('public')->assertExists($user->profile_image);
    }
}
