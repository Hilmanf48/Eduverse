<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
        ]);
        Quiz::create($validated);
        return back()->with('success', 'Ujian Akhir berhasil dibuat!');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load(['questions.answers' => function ($query) {
            $query->inRandomOrder();
        }]);

        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        //  Validasi input, pastikan semua pertanyaan dijawab
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required',
        ]);

        //  Ambil semua pertanyaan dari kuis ini beserta jawaban yang benar
        $questions = $quiz->questions()->with('answers')->get();
        
        $score = 0;
        $totalQuestions = $questions->count();
        $userAnswers = $request->input('answers');

        //  Loop setiap pertanyaan untuk memeriksa jawaban user
        foreach ($questions as $question) {
            // Cek apakah user menjawab pertanyaan ini
            if (isset($userAnswers[$question->id])) {
                $correctAnswer = $question->answers->where('is_correct', true)->first();
                
                // Jika jawaban user sama dengan ID jawaban yang benar
                if ($correctAnswer && $correctAnswer->id == $userAnswers[$question->id]) {
                    $score++;
                }
            }
        }

        //  Hitung skor akhir dalam bentuk persentase (0-100)
        $finalScore = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

        //  Simpan hasil percobaan kuis ke database
        QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $finalScore,
        ]);

        //  Arahkan user ke halaman hasil
        return redirect()->route('quizzes.result', ['quiz' => $quiz->id])
                         ->with('success', 'Kuis telah selesai! Lihat hasilmu.');
    }

}