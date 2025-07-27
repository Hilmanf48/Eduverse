<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\Auth;        
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Question;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
{
   
    $user = Auth::user();

    
    $quiz->load('course');
    if (!$quiz->course) {
        return redirect()->route('dashboard')->with('error', 'Kuis ini belum terhubung dengan kursus.');
    }

    $course = $quiz->course;

    
    $totalLessons = Lesson::whereHas('session', function ($q) use ($course) {
        $q->where('course_id', $course->id);
    })->count();

    $completedLessons = LessonProgress::where('user_id', $user->id)
        ->whereHas('lesson.session', function ($q) use ($course) {
            $q->where('course_id', $course->id);
        })->count();

  
    if ($totalLessons === 0 || $completedLessons < $totalLessons) {
        return redirect()->back()->with('error', 'Selesaikan semua materi sebelum mengerjakan kuis.');
    }

    $quiz->load(['questions.answers' => fn($query) => $query->inRandomOrder()]);

    
    return view('quizzes.show', compact('quiz'));
}

    public function submit(Request $request, Quiz $quiz)
    {
        // Validasi input
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer', 
        ]);

        
        $questions = $quiz->questions()->with('answers')->get();
        
        $correctAnswers = 0;
        $totalQuestions = $questions->count();
        $userAnswers = $validated['answers'];

        
        foreach ($questions as $question) {
            
            if (isset($userAnswers[$question->id])) {
                $correctAnswer = $question->answers->where('is_correct', true)->first();
                
                
                if ($correctAnswer && $correctAnswer->id == $userAnswers[$question->id]) {
                    $correctAnswers++;
                }
            }
        }

        
        $finalScore = ($totalQuestions > 0) ? round(($correctAnswers / $totalQuestions) * 100) : 0;

        
        $attempt = QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $finalScore,
        ]);

        
        return redirect()->route('quizzes.result', $attempt->id);
    }

     public function result(QuizAttempt $attempt)
    {
        
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        return view('quizzes.result', compact('attempt'));
    }
}
