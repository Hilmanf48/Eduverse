<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = \App\Models\Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function show(\App\Models\Course $course)
    {
        $user = auth()->user();
        $course->load('lessons');
        $completedLessons = $user->progress()->pluck('lesson_id');

    
        $user->tokens()->delete();
        $apiToken = $user->createToken('api-token')->plainTextToken;

        return view('courses.show', compact('course', 'completedLessons', 'apiToken'));
    }


}
