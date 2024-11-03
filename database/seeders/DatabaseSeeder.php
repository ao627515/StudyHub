<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UniversitySeeder::class,
            AcademicLevelSeeder::class,
            AcademicProgramSeeder::class,
            UserRoleSeeder::class
        ]);

        User::factory()->create([
            'email' => 'ao@ex.com',
            'role_id' => UserRole::where('name', "super-administrator")->first()->id
        ]);

        User::factory()->create([
            'email' => 'uploader@ex.com',
            'role_id' => UserRole::where('name', "uploader")->first()->id
        ]);
    }
}
