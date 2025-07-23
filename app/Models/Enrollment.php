<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Enrollment extends Model
{
    public function enrollments(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withTimestamps()
            ->withPivot(['completed_at', 'progress']);
    }

    /**
     * Relasi ke quiz attempts
     */
    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Relasi ke lesson progress
     */
    public function progress(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'lesson_progress')
            ->withTimestamps();
    }
}
