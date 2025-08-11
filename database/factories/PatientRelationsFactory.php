<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Relation;
use App\Models\User;
use App\Models\Facility;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientRelationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $relation = Relation::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        $facility = Facility::inRandomOrder()->first();

        return [
            'relation_name' => $this->faker->name(),
            'relation_id' => $relation->relation_id,
            'telephone' => $this->faker->phoneNumber,
            'user_id' =>  $user->user_id,
            'added_id' =>  $user->user_id,
            'facility_id' => $facility->facility_id,
            'added_date' => now(),
        ];
    }
}
