<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\Advert;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdvertLearnerSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = Skill::all();
        $users = User::all();
        $adverts = Advert::all();

        $skills->each(function ($skill) use ($users, $adverts) {
            // Randomly choose between partner and advert
            if (rand(0, 1)) {
                $user = $users->random();
                $skill->users()->attach($user->id);
            } else {
                $advert = $adverts->random();
                $skill->adverts()->attach($advert->id);
            }
        });
    }
}
