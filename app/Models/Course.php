<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];

    
    public function lessons() {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }
}

