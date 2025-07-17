<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    /**
     * Menampilkan daftar semua kursus.
     */
    public function index()
    {
        $courses = Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Menampilkan halaman detail kursus, video, dan status ujian.
     */
    public function show(Course $course)
    {
        $user = auth()->user();

        // 1. Muat semua data yang diperlukan dengan efisien
        $course->load(['sessions.lessons', 'finalExam']);

        // 2. Hitung total video dalam kursus ini
        $totalLessonsCount = $course->lessons->count();

        // 3. Ambil semua ID video yang sudah diselesaikan user untuk kursus ini
        $completedLessons = $user->progress()
                              ->whereIn('lesson_id', $course->lessons->pluck('id'))
                              ->pluck('lesson_id');
        $completedLessonsCount = $completedLessons->count();

        // 4. Logika Penguncian Ujian Akhir
        $isExamUnlocked = ($totalLessonsCount > 0 && $completedLessonsCount >= $totalLessonsCount);

        // 5. Buat token API untuk progress video
        $user->tokens()->delete();
        $apiToken = $user->createToken('api-token')->plainTextToken;

        // 6. Kirim semua data yang dibutuhkan ke view
        return view('courses.show', compact(
            'course',
            'completedLessons',
            'apiToken',
            'isExamUnlocked'
        ));
    }
}