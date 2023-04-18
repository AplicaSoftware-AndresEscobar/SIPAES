<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'nit' => "{$this->faker->randomNumber(4)}{$this->faker->randomNumber(5)}.{$this->faker->randomDigit()}",
            'address' => $this->faker->address(),
            'phone' => $this->faker->unique()->phoneNumber(),
        ];
    }
}
