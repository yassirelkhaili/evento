<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Partner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advert>
 */
class AdvertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dbIds = Partner::pluck("id")->toArray();
        return [
            "title" => $this->faker->sentence,
            "content" => $this->faker->paragraph,
            "partnerID" => $this->faker->randomElement($dbIds), 
        ];
    }
}