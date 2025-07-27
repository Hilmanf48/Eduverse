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
    
    
    public function index()
    {
        $courses = Course::with('category')->get();
        $categories = Category::all();
        return view('courses.index', compact('courses', 'categories'));

$featuredCourses = $courses->map(function ($course) {
    return [
        'id' => $course->id,
        'title' => $course->title,
        'description' => $course->description,
        'category_name' => $course->category->name ?? 'Uncategorized',
        'category' => strtolower($course->category->name ?? 'uncategorized'),
        'image' => asset('storage/' . $course->image_path),
    ];
});
return view('client.landing', [
    'featuredCourses' => $featuredCourses,
    'categories' => $categories,
]);


    }

    /**
     
     */
    public function show(Course $course)
{
    $user = Auth::user();

    
    if (!$user->api_token) {
        $user->api_token = Str::random(60);
        $user->save();
    }

    
    $publishedSessions = LearningSession::where('course_id', $course->id)
        ->where('is_published', true)
        ->with(['lessons', 'quiz']) 
        ->get();

   
    $allLessons = \App\Models\Lesson::whereIn('session_id', $publishedSessions->pluck('id'))
        ->get();

    
    $completedLessons = \App\Models\LessonProgress::where('user_id', $user->id)
        ->whereIn('lesson_id', $allLessons->pluck('id'))
        ->pluck('lesson_id');

    
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