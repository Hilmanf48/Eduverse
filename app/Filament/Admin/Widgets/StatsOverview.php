<?php


namespace App\Filament\Admin\Widgets;

use App\Models\User;
use App\Models\Course;
use App\Models\LearningSession;
use App\Models\Quiz;
use App\Models\Question;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getCards(): array
    {
        return [
            Card::make('Total User', User::count())->icon('heroicon-o-user-group')->description('Seluruh pengguna'),
            Card::make('Total Kursus', Course::count())->icon('heroicon-o-book-open'),
            Card::make('Total Sesi', LearningSession::count())->icon('heroicon-o-chart-bar'),
            Card::make('Total Kuis', Quiz::count())->icon('heroicon-o-clipboard-document-check'),
            Card::make('Total Pertanyaan', Question::count())->icon('heroicon-o-question-mark-circle'),
        ];
    }
}
