<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserWorkExperiencie>
 */
class UserWorkExperiencieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => $this->faker->jobTitle(),
            'start_date' => $startDate = $this->faker->dateTimeBetween('-20 years', '-1 year'),
            'end_date' => $this->faker->dateTimeBetween($startDate, '+ 20 years')
        ];
    }
}
