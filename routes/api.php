<?php

use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::post('/lessons/{lesson}/complete', function (App\Models\Lesson $lesson, Request $request) {
    $user = Auth::guard('web')->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    $exists = LessonProgress::where('user_id', $user->id)
        ->where('lesson_id', $lesson->id)
        ->exists();

    if (!$exists) {
        LessonProgress::create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
        ]);
    }

    return response()->json([
        'message' => 'Lesson marked as complete',
    ]);
});

