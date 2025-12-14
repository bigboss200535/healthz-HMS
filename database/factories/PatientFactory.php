<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Occupation;
use App\Models\Religion;
use App\Models\Title;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
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
        $title = Title::inRandomOrder()->first();
        $religion = Religion::inRandomOrder()->first(); 
        $nationality = Nationality::inRandomOrder()->first(); 
        $occupation = Occupation::inRandomOrder()->first(); 
       
        return [
            'patient_id' => Str::uuid(),
            'title_id' => $title->title_id,
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->randomElement(['Antwi', 'Kwame', 'Eunice', 'Kwabena', 'Yaw', 'Asan', 'T.', 'M.', 'A', 'T.']),
            'lastname' => $this->faker->lastName,
            'birth_date'=>$this->faker->date('Y-m-d'),
            'gender_id'=> $this->faker->randomElement(['2', '3']),
            'telephone' => $this->faker->phoneNumber,
            'occupation_id' => $occupation->occupation_id,
            'education' => $this->faker->randomElement(['None', 'JHS/Middle', 'Primary', 'SHS', 'Tertiary', 'Vocational', 'Technical']),
            'religion_id' => $religion->religion_id,
            'nationality_id' => $nationality->nationality_id,
            'telephone_verified' => $this->faker->randomElement(['Yes', 'No']),
            'email' => $this->faker->email(),
            'address' => $this->faker->city(),
            'user_id' =>  $user->user_id,
            'added_id' =>  $user->user_id
        ];
    }
}
