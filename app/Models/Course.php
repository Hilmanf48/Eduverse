<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LearningSession;
use App\Models\Quiz;

class Course extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function sessions()
    {
        return $this->hasMany(LearningSession::class)->orderBy('order');
    }
    
    public function lessons() 
    {
        return $this->hasManyThrough(
        Lesson::class,
        LearningSession::class,
        'course_id', // Foreign key di tabel learning_sessions
        'session_id'  // Foreign key di tabel lessons
    );
        
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }
    
    public function finalExam()
    {
    
        return $this->hasOne(Quiz::class);
    }
}

