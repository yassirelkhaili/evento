<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::factory()->count(50)->create();
       $roles = Role::all()->pluck('name');
       User::all()->each(function ($user) use ($roles) {
           $user->assignRole($roles->random());
       });
   }
}
