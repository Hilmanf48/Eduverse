<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;


class LessonProgressController extends Controller
{
    public function store(Request $request, Lesson $lesson)
{
    $user = Auth::user();

    $progress = \App\Models\LessonProgress::firstOrCreate([
        'user_id' => $user->id,
        'lesson_id' => $lesson->id,
    ]);

    return response()->json([
        'user_id' => $user->id,
        'lesson_id' => $lesson->id,
        'message' => 'Tes berhasil masuk controller',
    ]);
}
}
