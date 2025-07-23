<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::first();
       $courses = Course::take(3)->get();

        $user->enrollments()->attach($courses, [
            'progress' => rand(10, 100),
            'created_at' => now(),
            'updated_at' => now()
    ]);
    }
}
