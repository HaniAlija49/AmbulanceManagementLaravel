#  Software Engineering Project
## Ambulance Management System
### Overview

The Ambulance Management System is a web-based solution designed to streamline and enhance the efficiency of ambulance services and associated administrative tasks within healthcare settings. This repository contains the source code and documentation for the project.

## Features

- **Appointment Scheduling:** Efficient and automated scheduling of appointments for patients.
- **Patient Records Management:** Centralized storage and management of patient information.
- **Staff Management:** Maintenance of records for doctors, nurses, and administrative personnel.
- **Report Generation:** Creation and storage of reports related to patient appointments.

## Installation
To install and use this application, follow these steps:

1 - **Clone this repository to your local machine :**

**Clone with SSH:** git clone git@gitlab.com:ambulance-management-system/ambulance-management-system.git

**Clone with HTTPS:** git clone https://gitlab.com/ambulance-management-system/ambulance-management-system.git

2 - **Start XAMPP** application and click start button on Apache and MySQL.

3 - **Set up the database** by creating a new MySQL database, and update the .env file with your database credentials : 
.env.example .env
php artisan migrate
Also seed the database with this command: php artisan db:seed --class=UserSeeder

4 - **Start the server:** 
php artisan serve

5 -  **Login with the account that is saved after seeding the database:**
   - Use the following credentials for the first login:
     - **Email:** admin@admin.com
     - **Password:** Admin123@

### Usage
To use this application, simply login with the information above and register new users(patients, doctors, nurses). Try making new appointments and write reports for those appointments. Make sure to try all the features of the project.

##### Milestone 1: Planning Tasks:
    -Define the scope of the project 
    -Create use case diagram
    -Create class diagram 
    -Assign team roles and responsibilities 
    -Define timelines 

##### Deliverables:
    -Use case diagram 
    -Class diagram 
    -Project scope document 
    -Team roles  
    -Project timeline  
    Timeline: 1 week


##### Milestone 2: System Design Tasks:
    -Design the database schema 
    -Select the programming languages and technologies 
    -Define the system development environment and tools 

##### Deliverables:
    -Database schema document 
    -Selected programming languages and technologies document 
    -System development environment and tools document 
    Timeline: 1 week


##### Milestone 3: System Development Tasks:
    -Develop the User (Admin, Patient, Nurse & Doctor), Appointment, Report Models 
    -Implement the user interface.
    -Develop the necessary functions and features of the system 

##### Deliverables:
    -Developed User (Admin, Patient, Nurse & Doctor), Appointments, Reports Models
    -Implemented user interface 
    -System functions and features document 
    Timeline: 1 weeks

##### Milestone 4: Testing Tasks:
    -Develop and perform unit testing for each class 
    -Identify and resolve defects 

##### Deliverables:
    -Unit testing document  
    -Defects log 


##  Models
#### User Model
##### Roles 
##### Admin:
- Registers users (patients doctors, nurses).
- View all patients, doctors, nurses and have access to their information.

##### Patient:
- Login to the system.
- Make appointment.
- View his/her reports

##### Doctor:
- Login to the system.
- Manage appointments with patients.
- Write reports for appointments.

##### Nurse:
- Login to the system.
- Manage patient information.
- Manage reports.



##  Use Case Diagram

- The system has 4 types of actors: Administrator, Patient, Doctor, Nurse.
- The administrator can login, register users and manage users.
- The patient can login, make appointment, view report.
- The doctor can login, manage appointment, write report.
- The nurse can login. manage patient information.


![](usecasediagram.png)

## Class Diagram

#### User registration
- The admin can register users (patients, doctors, nurses) and manage them
#### Login
- All the users can login (admin, patients, doctors, nurses)
#### Manage patients
- The doctors and nurses can manage patients.
#### Make appointment
- The doctors and patients can make appointments
#### Write report
- The doctors and nurses can write report.

![](classdiagram.png)




## Unit Testing

##### Admin registers patient

public function test_user_can_register_as_patient()

    {

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



##### Doctor create appointment

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


##### Doctor create report

public function testDoctorCanCreateReport()

    {
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


## Technologies Used

- **Laravel:** web application framework with expressive, elegant syntax - freeing you to create without sweating the small things..
- **PHP:** An extremely popular scripting language that is used to create dynamic Web pages.
- **MySQL:** A relational database management system organized into physical files optimized for speed.
- **HTML, CSS, JavaScript:** Front-end technologies for the user interface.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, feel free to open an issue or submit a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- The Ambulance Management System was developed by [Hani Alija](https://github.com/HaniAlija49), [Jasin Ismaili](https://github.com/jasini1), and [Uvejs Murtezi](https://github.com/uvejsm) as part of their software engineering project at Southeast European University.

### Conclusion
We hope that this Ambulance Management System will be useful for you. If you have any questions or comments, please feel free to reach out to us.
Thank you for checking out the Ambulance Management System!
