<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sizes = ['small', 'medium', 'large'];

        return [
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'industry' => $this->faker->word,
            'size' => $this->faker->randomElement($sizes),
            'location' => $this->faker->city
        ];
    }
}
