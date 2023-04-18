<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInformation>
 */
class UserInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomPrefix = ['310', '311', '312', '313', '314', '315', '316', '317', '318', '320'];
        return [
            'fullname' => "{$this->faker->name} {$this->faker->lastName}",
            'email_fesc' => $this->faker->freeEmailDomain(),
            'document' => "1090{$this->faker->unique()->randomNumber(8)}",
            'address' => $this->faker->address(),
            'phone' => $randomPrefix[rand(0, count($randomPrefix) - 1)] . $this->faker->randomNumber(7),
            'birthdate' => $this->faker->dateTimeBetween('-40 years', '-18 years'),
        ];
    }
}
