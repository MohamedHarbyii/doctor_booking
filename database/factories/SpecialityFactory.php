<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speciality>
 */
class SpecialityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    $specialties = [
            'Cardiology', 'Dermatology', 'Neurology', 'Pediatrics', 
            'Orthopedics', 'Ophthalmology', 'Psychiatry', 'Dentistry'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($specialties),
        ];
    }
}
