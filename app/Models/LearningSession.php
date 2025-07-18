<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class LearningSession extends Model
{
    
   use HasFactory;
    protected $table = 'learning_sessions';
    protected $fillable = ['course_id', 'title', 'order'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function lessons()
    {

        return $this->hasMany(Lesson::class, 'session_id')->orderBy('order');
    }
}
