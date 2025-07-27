<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LearningSession;
use App\Models\Quiz;

class Course extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'description', 'image_path', 'category_id'];

    public function sessions()
    {
        return $this->hasMany(LearningSession::class)->orderBy('order');
    }
    
    public function lessons() 
    {
        return $this->hasManyThrough(
        Lesson::class,
        LearningSession::class,
        'course_id', 
        'session_id'         
    );
        
    }

 // public function quiz()
 // {
//  return $this->hasManyThrough(
//      \App\Models\Quiz::class,
//      \App\Models\LearningSession::class,
//      'course_id',      
//      'learning_session_id', 
//      'id',             
//      'id'              
//  );

public function quizzes()
{
    return $this->hasManyThrough(
        \App\Models\Quiz::class,
        \App\Models\LearningSession::class,
        'course_id',
        'learning_session_id',
        'id',
        'id'
    );
}

    
    
    public function finalExam()
{
    return $this->hasOneThrough(
        \App\Models\Quiz::class,
        \App\Models\LearningSession::class,
        'course_id',            
        'learning_session_id',  
        'id',                   
        'id'                    
    );
}

    public function category() {
        return $this->belongsTo(Category::class);
        
    }

    public function completedLessons()
    {
        return $this->hasManyThrough(
            LessonProgress::class,   
            Lesson::class,
            'session_id',
            'lesson_id',
            'id',
            'id'
        )->whereHas('lesson.session', function ($query) {
        $query->whereColumn('course_id', 'courses.id');
        });
    }
    public function videos()
{
    return $this->hasMany(Video::class);
}
public function learningSessions()
{
    return $this->hasMany(\App\Models\LearningSession::class);
}
}

