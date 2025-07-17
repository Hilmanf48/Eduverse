<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizAttempt;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // 1. Ambil 5 hasil kuis terakhir
        $recentAttempts = QuizAttempt::where('user_id', $user->id)
            ->with('quiz.course') // Ambil relasi untuk judul
            ->latest()
            ->take(5)
            ->get();

        // 2. Hitung progres belajar keseluruhan
        $totalLessons = Lesson::count();
        $completedLessons = $user->progress()->count();
        $overallProgress = ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;

        // 3. Siapkan data untuk grafik
        $range = $request->input('range', 'week'); // default 1 minggu
        switch ($range) {
            case 'month':
                $startDate = Carbon::now()->subMonth();
                $dateFormat = '%Y-%m-%d';
                break;
            case 'year':
                $startDate = Carbon::now()->subYear();
                $dateFormat = '%Y-%m';
                break;
            default:
                $startDate = Carbon::now()->subWeek();
                $dateFormat = '%Y-%m-%d';
        }

        $activityData = $user->progress()
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw("DATE_TRUNC('day', created_at) as date"),
                DB::raw('COUNT(*) as count')
            ]);

        $chartLabels = $activityData->pluck('date')->map(function($date) {
            return Carbon::parse($date)->format('d M');
        });
        $chartData = $activityData->pluck('count');

        return view('dashboard', compact(
            'recentAttempts',
            'overallProgress',
            'chartLabels',
            'chartData',
            'range' // untuk menandai tombol filter yang aktif
        ));
    }
}