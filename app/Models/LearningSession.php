<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class LearningSession extends Model
{
    
   use HasFactory;
    protected $table = 'learning_sessions';
    protected $fillable = [
        'course_id',
        'title',
        'order',
        'is_published'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function lessons()
    {
        return $this->hasMany(\App\Models\Lesson::class, 'session_id')->orderBy('order');
    }
    public function videos()
    {
     return $this->hasMany(Video::class, 'learning_session_id');
    }
    public function quiz()
    {
        return $this->hasOne(\App\Models\Quiz::class, 'learning_session_id');
    }
    public function quizzes()
    {
        return $this->hasMany(\App\Models\Quiz::class, 'learning_session_id');
    }



    
}
