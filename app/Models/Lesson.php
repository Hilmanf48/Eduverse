<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LearningSession;

class Lesson extends Model
{
    public function course() {
    return $this->belongsTo(Course::class);
}

    public function session()
{
    return $this->belongsTo(\App\Models\LearningSession::class, 'session_id');
}

    protected $fillable = [
        'session_id',
        'title',
        'youtube_video_id',
        'order',
    ];

}
