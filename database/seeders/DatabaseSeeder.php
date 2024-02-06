<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    $adminRole = Role::create(['name' => 'Admin']);
    $learnerRole = Role::create(['name' => 'Learner']);
    $permission = Permission::findOrCreate("access-admin-dashboard");
    $permission->assignRole("Admin");
    }
}
