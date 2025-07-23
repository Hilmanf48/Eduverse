<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'course_id',
        'learning_session_id',

    ];

    public function course()
{
    return $this->belongsTo(Course::class);
}

public function learningSession()
{
    return $this->belongsTo(LearningSession::class);
}

public function quiz()
{
    return $this->belongsTo(Quiz::class);
}

public function answers()
{
    return $this->hasMany(Answer::class);
}

}
