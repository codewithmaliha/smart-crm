<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@brand.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Staff
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@brand.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);

        // Student
        User::create([
            'name' => 'Student User',
            'email' => 'student@brand.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // Seed University and Course
        $uni = \App\Models\University::create([
            'name' => 'Global Tech University',
            'country' => 'United Kingdom',
            'website' => 'https://globaltech.edu',
            'description' => 'A leading university in technology.',
        ]);

        \App\Models\Course::create([
            'university_id' => $uni->id,
            'name' => 'MSc Computer Science',
            'level' => 'Postgraduate',
            'intake' => 'Sep 2025',
            'tuition_fee' => 15000.00,
            'duration' => '1 Year',
        ]);
    }
}
