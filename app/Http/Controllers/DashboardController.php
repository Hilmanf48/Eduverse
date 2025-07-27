<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizAttempt;
use App\Models\Lesson;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $isNewUser = $user->quizAttempts->isEmpty()
        && $user->progress->isEmpty()
        && (!method_exists($user, 'enrollments') || $user->enrollments->isEmpty());
        if ($isNewUser) {
            return view('dashboard', [
                'recentAttempts' => collect(),
                'chartLabels' => [],
                'chartData' => [],
                'chartDatasetLabel' => 'Aktivitas Belajar',
                'overallProgress' => 0,
                'activeCourses' => 0,
                'completedModules' => 0,
                'courseProgress' => collect(),
                'courses_taken' => 0,
                'quizzes_completed' => 0,
                'learning_hours' => 0,
                'points' => 0,
                'range' => $request->input('range', 'week')
            ]);
        }
        
        // 1. Data untuk stat cards
        $stats = [
            'courses_taken' => method_exists($user, 'enrollments') 
                ? $user->enrollments()->count() 
                : 0,
            'quizzes_completed' => $user->quizAttempts()->count(),
            'learning_hours' => $this->calculateLearningHours($user),
            'points' => $user->points ?? 0 // Fallback 
        ];

        // 2. Ambil 5 hasil kuis terakhir
        $recentAttempts = QuizAttempt::where('user_id', $user->id)
            ->with(['quiz.course', 'quiz']) 
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($attempt) {
                return [
                    'id' => $attempt->id,
                    'course_title' => $attempt->quiz->course->title ?? 'Kuis Umum',
                    'quiz_title' => $attempt->quiz->title,
                    'score' => round($attempt->score),
                    'passed' => $attempt->score >= 70,
                    'created_at' => $attempt->created_at->diffForHumans(),
                    'review_url' => route('quizzes.show', $attempt->id)
                ];
            });

        // 3. Hitung progres belajar
        $progressData = $this->calculateLearningProgress($user);

        // 4. Data aktivitas untuk chart
        $chartData = $this->getActivityData($user, $request->input('range', 'week'));

        return view('dashboard', array_merge(
            $stats,
            $progressData,
            $chartData,
            [
                'recentAttempts' => $recentAttempts,
                'range' => $request->input('range', 'week')
            ]
        ));
    }

    /**
     * 
     */
    protected function calculateLearningHours($user)
    {
        return $user->progress()
            ->join('lessons', 'lesson_progress.lesson_id', '=', 'lessons.id')
            ->sum('lessons.duration') / 60; 
    }

    /**
     * 
     */
    protected function calculateLearningProgress($user)
    {
        $totalLessons = Lesson::count();
        $completedLessons = $user->progress()->count();
        
       
        $courseProgress = Course::withCount(['lessons', 'completedLessons' => function($q) use ($user) {
                $q->where('user_id', $user->id);
            }])
            ->get()
            ->map(function ($course) {
                $progress = $course->lessons_count > 0 
                    ? ($course->completed_lessons_count / $course->lessons_count) * 100 
                    : 0;
                
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'progress' => round($progress),
                    'active' => $progress > 0 && $progress < 100
                ];
            });

        return [
            'overallProgress' => $totalLessons > 0 
                ? round(($completedLessons / $totalLessons) * 100) 
                : 0,
            'activeCourses' => $courseProgress->where('active', true)->count(),
            'completedModules' => $completedLessons,
            'courseProgress' => $courseProgress
        ];
    }

    /**
     * 
     */
    protected function getActivityData($user, $range = 'week')
    {
        $ranges = [
            'week' => [Carbon::now()->subWeek(), 'day', 'd M'],
            'month' => [Carbon::now()->subMonth(), 'day', 'd M'],
            'year' => [Carbon::now()->subYear(), 'month', 'M Y']
        ];

        [$startDate, $groupBy, $dateFormat] = $ranges[$range] ?? $ranges['week'];

        $activityData = $user->progress()
            ->where('created_at', '>=', $startDate)
            ->select(
                DB::raw("DATE_TRUNC('$groupBy', created_at) as date_group"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date_group')
            ->orderBy('date_group')
            ->get();

       
        $labels = $activityData->map(function ($item) use ($dateFormat) {
            return Carbon::parse($item->date_group)->format($dateFormat);
        });

        return [
            'chartLabels' => $labels,
            'chartData' => $activityData->pluck('count'),
            'chartDatasetLabel' => 'Aktivitas Belajar'
        ];
    }
}