<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    protected $fillable = [
        'title',
        'youtube_video_id',
        'course_id',
        'learning_session_id',
    ];

    public function session()
    {
        return $this->belongsTo(LearningSession::class, 'learning_session_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function learningSession()
    {
        return $this->belongsTo(LearningSession::class, 'learning_session_id');
    }

}
