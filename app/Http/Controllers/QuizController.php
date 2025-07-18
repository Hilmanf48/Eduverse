<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        // Muat relasi pertanyaan, dan untuk setiap pertanyaan, muat relasi jawabannya
        // Jawaban acak urutan agar tidak selalu sama
        $quiz->load(['questions.answers' => function ($query) {
            $query->inRandomOrder();
        }]);

        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        // Validasi input
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer', 
        ]);

        // Ambil semua pertanyaan dari kuis beserta jawaban yang benar
        $questions = $quiz->questions()->with('answers')->get();
        
        $correctAnswers = 0;
        $totalQuestions = $questions->count();
        $userAnswers = $validated['answers'];

        // Loop setiap pertanyaan untuk memeriksa jawaban user
        foreach ($questions as $question) {
            
            if (isset($userAnswers[$question->id])) {
                $correctAnswer = $question->answers->where('is_correct', true)->first();
                
                // Jika jawaban user sama dengan ID jawaban yang benar
                if ($correctAnswer && $correctAnswer->id == $userAnswers[$question->id]) {
                    $correctAnswers++;
                }
            }
        }

        //  Hitung skor akhir dalam bentuk persentase (0-100)
        $finalScore = ($totalQuestions > 0) ? round(($correctAnswers / $totalQuestions) * 100) : 0;

        // Simpan hasil percobaan kuis ke database
        $attempt = QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $finalScore,
        ]);

        // Arahkan user ke halaman hasil
        return redirect()->route('quizzes.result', $attempt->id);
    }

     public function result(QuizAttempt $attempt)
    {
        // Pastikan user hanya bisa melihat hasilnya sendiri
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        return view('quizzes.result', compact('attempt'));
    }
}
