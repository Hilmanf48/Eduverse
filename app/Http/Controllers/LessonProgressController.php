<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonProgressController extends Controller
{
    public function store(Request $request, Lesson $lesson)
    {
        $user = $request->user();

        UserProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'completed' => true 
            ]
        );

        return response()->json(['success' => true]);
    }
}
