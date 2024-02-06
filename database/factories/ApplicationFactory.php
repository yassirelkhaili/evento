<?php

namespace Database\Factories;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck("id")->toArray();
        $advertIds = Advert::pluck("id")->toArray();
        $statusValues = ['Pending', 'Accepted', 'Rejected', 'Under Review', 'Interview Scheduled', 'Offer Extended', 'Offer Accepted', 'Offer Declined'];
        return [
            "learner_id" => $this->faker->randomElement($userIds),
            "advert_id" => $this->faker->randomElement($advertIds),
            "status" => $this->faker->randomElement($statusValues),
        ];
    }
}
