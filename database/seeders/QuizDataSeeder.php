<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;

class QuizDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat course
        $course = Course::firstOrCreate([
            'title' => 'Sample Course',
            'description' => 'Course Description'
        ]);

        // 2. Buat quiz
        $quiz = Quiz::firstOrCreate([
            'course_id' => $course->id,
            'title' => 'Sample Quiz'
        ]);

        // 3. Gunakan user admin yang sudah ada
        $user = User::where('email', 'admin@eduverse.com')->first();

        // 4. Buat quiz attempts
        QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => 85.50,
            'completed_at' => now()
        ]);
    }
}