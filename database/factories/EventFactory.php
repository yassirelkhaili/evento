<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'available_seats' => $this->faker->numberBetween(50, 100),
            'capacity' => $this->faker->numberBetween(100, 200),
            'validation_method' => $this->faker->randomElement(['manual', 'automatic']),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
