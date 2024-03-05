<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesandpermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // roles
         $userRole = Role::create(['name' => 'user']);
         $adminRole = Role::create(['name' => 'administrator']);
         $organizerRole = Role::create(['name' => 'organizer']);
         // admin permissions
         $manageUsers = Permission::create(['name' => 'manage users'])->assignRole($adminRole);
         $manageEventCategories = Permission::create(['name' => 'manage event categories'])->assignRole($adminRole);
         $validateEvents = Permission::create(['name' => 'validate events'])->assignRole($adminRole);
         //organizer permissions
         $manageOwnEvents = Permission::create(['name' => 'manage own events'])->assignRole($organizerRole);
         $manageValidationMethod = Permission::create(['name' => 'manage validation method'])->assignRole($organizerRole);
    }
}
