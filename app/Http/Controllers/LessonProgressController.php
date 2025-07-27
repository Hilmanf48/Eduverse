<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;
use App\Models\LessonProgress;

class LessonProgressController extends Controller
{
    public function markAsComplete(Lesson $lesson, Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $already = LessonProgress::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->exists();

        if (!$already) {
            LessonProgress::create([
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
                'completed_at' => now(),
            ]);
        }

        return response()->json(['success' => true]);
    }
}

