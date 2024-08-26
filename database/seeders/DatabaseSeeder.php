<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users
        (new \Database\Seeders\UserSeeder)->run();

        // Seed roles and permissions
        (new \Database\Seeders\RolesAndPermissionsSeeder)->run();

        // Assing role to admin and super user
        \App\Models\User::where('id', 1)->firstOrFail()->assignRole(\App\Enums\Roles\RoleEnum::SUPER);
        \App\Models\User::where('id', 2)->firstOrFail()->assignRole(\App\Enums\Roles\RoleEnum::ADMIN);
    }
}
