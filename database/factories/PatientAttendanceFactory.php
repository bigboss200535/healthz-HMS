<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientAttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $gender = Gender::inRandomOrder()->where('usage','=','1')->first();
        $patient = Patient::inRandomOrder()->where('archived', '=', 'No')->first();

       return [
            'patient_id' =>  $patient->patient_id,
            'attendance_date'=> now(),
            'attendance_time' => now(),
            'pat_age' => $this->faker->randomElement(['19', '20', '21', '50', '1', '2']),

            'education' => $this->faker->randomElement(['None', 'JHS/Middle', 'Primary', 'SHS', 'Tertiary', 'Vocational', 'Technical']),
            // 'religion_id' => $religion->religion_id,
            'nationality' => $this->faker->randomElement(['10001', '20001']),
            'telephone' => $this->faker->phoneNumber(),
            'telephone_verified' => $this->faker->randomElement(['Yes', 'No']),
            'email' => $this->faker->email(),
            'address' => $this->faker->city(),
            'contact_person' => $this->faker->firstName,
            'contact_telephone' => $this->faker->phoneNumber,
            'contact_relationship' => $this->faker->colorName(),
            // 'contact_relationship' => $this->faker->city(),
            'user_id' =>  $user->user_id,
            // 'remember_token' => Str::random(10),
        ];
    }
}
