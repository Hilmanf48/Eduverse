<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*.text' => 'required|string',
            'answers.*.is_correct' => 'sometimes|boolean',
        ]);

        $question = Question::create([
            'quiz_id' => $validated['quiz_id'],
            'question_text' => $validated['question_text'],
        ]);

        foreach ($validated['answers'] as $answerData) {
            if (!empty($answerData['text'])) {
                $question->answers()->create([
                    'answer_text' => $answerData['text'],
                    'is_correct' => $answerData['is_correct'] ?? 0,
                ]);
            }
        }
        return back()->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return back()->with('success', 'Pertanyaan berhasil dihapus!');
    }
}