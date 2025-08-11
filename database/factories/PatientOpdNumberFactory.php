<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientOpdNumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $patient = Patient::inRandomOrder()->first();
        $clinic = Clinic::inRandomOrder()->first();
         $facility = Facility::inRandomOrder()->first();

        return [
            // 'patient_id' => $patient->patient_id,
            'opd_number' => 'A'.$this->faker->randomNumber(8, true).'/24',
            'clinic_id' => $clinic->clinic_id,
            'user_id' =>  $user->user_id,
            'registration_date' => now(),
            'registration_time' => now(),
            'facility_id' => $facility->facility_id,
            'year' => date('Y'),
            'month' => date('m'),
            'added_date' => now(),
        ];
    }
}
