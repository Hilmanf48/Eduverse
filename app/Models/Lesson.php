<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function course() {
    return $this->belongsTo(Course::class);
}

protected $fillable = [
    'course_id',
    'title',
    'youtube_video_id',
    'order',
];

}
