<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Quiz;
use App\Models\LearningSession;






class CourseController extends Controller
{
    /**
     * Menampilkan daftar semua kursus.
     */
    public function index()
    {
        $courses = Course::latest()->get();
        $courses = Course::with('category')->latest()->get();
        $categories = Category::all();
        return view('courses.index', compact('courses'));
    }

    /**
     
     */
    public function show(Course $course)
{
    $user = Auth::user();

    // Generate API token jika belum ada
    if (!$user->api_token) {
        $user->api_token = Str::random(60);
        $user->save();
    }

    // Ambil semua sesi yang aktif
    $publishedSessions = LearningSession::where('course_id', $course->id)
        ->where('is_published', true)
        ->with(['lessons', 'quiz']) // pastikan relasi ada
        ->get();

    // Ambil semua pelajaran dari sesi
    $allLessons = \App\Models\Lesson::whereIn('session_id', $publishedSessions->pluck('id'))
        ->get();

    // Ambil lesson yang sudah diselesaikan user
    $completedLessons = \App\Models\LessonProgress::where('user_id', $user->id)
        ->whereIn('lesson_id', $allLessons->pluck('id'))
        ->pluck('lesson_id');

    // Unlock exam jika semua lesson selesai
    $isExamUnlocked = $allLessons->count() > 0 && $completedLessons->count() === $allLessons->count();

    return view('courses.show', [
        'course' => $course,
        'sessions' => $publishedSessions,
        'allLessons' => $allLessons,
        'completedLessons' => $completedLessons,
        'isExamUnlocked' => $isExamUnlocked,
        'apiToken' => $user->api_token,
    ]);

}


    public function edit(Course $course)
    {
        
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }
}