<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonProgress;

class CourseProgress extends Component
{
    public Course $course;
    public $completedLessonIds = [];
    public bool $isExamUnlocked = false;

    protected $listeners = ['lessonCompleted' => 'refreshProgress'];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->refreshProgress();
        $this->completedLessons = LessonProgress::where('user_id', auth()->id())
            ->whereIn('lesson_id', $course->sessions->flatMap->lessons->pluck('id'))
            ->pluck('lesson_id')
            ->toArray();
        $this->refreshProgress();
    }

    public function refreshProgress()
{
    $this->completedLessonIds = Auth::user()
        ->progress()
        ->whereIn('lesson_id', $this->course->sessions->flatMap->lessons->pluck('id'))
        ->pluck('lesson_id')
        ->toArray();

    $this->isExamUnlocked = count($this->completedLessonIds) === $this->course->sessions->flatMap->lessons->count();
}
public function getIsExamUnlockedProperty()
    {
        $totalLessons = $this->course->sessions->flatMap->lessons->count();
        return count($this->completedLessonIds) === $totalLessons;
    }

    public function render()
    {
        return view('livewire.course-progress', [
            'isExamUnlocked' => $this->isExamUnlocked, 
            'completedLessons' => $this->completedLessonIds,
        ]);
    }
    public array $completedLessons = [];



}
