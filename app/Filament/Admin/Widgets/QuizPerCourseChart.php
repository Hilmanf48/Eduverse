<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Widgets\BarChartWidget;
use App\Models\Course;
use App\Models\LearningSession;

use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;

class QuizPerCourseChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $courses = Course::with('learningSessions.quizzes')->get();

    $labels = [];
    $counts = [];

    foreach ($courses as $course) {
        $labels[] = $course->title;
        $quizCount = $course->learningSessions->flatMap->quizzes->count();
        $counts[] = $quizCount;
    }

    return [
        'datasets' => [
            [
                'label' => 'Total Quiz per Kursus',
                'data' => $counts,
            ],
        ],
        'labels' => $labels,
    ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
