<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Gender;
use App\Models\Patient;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientAdmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $dc = User::inRandomOrder()->first();
        $patient = Patient::inRandomOrder()->where('archived', '=', 'No')->first();

        return [
            'admissions_id' => Str::uuid(),
            'patient_id' => $patient->patient_id,
            'doctor_id' =>  $dc->user_id,
            //  'admission_date' => $this->faker->date('Y-m-d'),
             'user_id' =>  $user->user_id,
         ];
    }
}
