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
        $this->call([
            CompanySeeder::class,
            EducationalInstituteSeeder::class,
            AcademicStudyLevelSeeder::class,
            GenderSeeder::class,
            DocumentTypeSeeder::class,
            LocalizationSeeder::class,
            RoleAndPermissionSeeder::class,
            UserSeeder::class,
            SchoolLocationSeeder::class,
            JourneySeeder::class,
        ]);
    }
}
