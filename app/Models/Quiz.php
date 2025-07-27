<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Question;



class Quiz extends Model
{
   use HasFactory;

    protected $fillable = ['course_id', 'title'];

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
    
    public function course()
{
    return $this->belongsTo(Course::class);
}
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function session()
    {
        return $this->belongsTo(LearningSession::class, 'learning_session_id');
    }
    public function learningSession()
{
    return $this->belongsTo(LearningSession::class);
}

    
}
