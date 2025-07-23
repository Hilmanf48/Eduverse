<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VideoResource\Pages;
use App\Filament\Admin\Resources\VideoResource\RelationManagers;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Resources\Table;
use App\Models\Course;
use App\Models\LearningSession;

class VideoResource extends Resource
{
   protected static ?string $model = Video::class;
    protected static ?string $navigationGroup = 'Course Management';
    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    public static function form(Forms\Form $form): Forms\Form
        {
            return $form->schema([
            Select::make('course_id')
                ->label('Pilih Kursus')
                ->options(Course::all()->pluck('title', 'id'))
                ->reactive()
                ->required(),

            Select::make('learning_session_id')
                ->label('Pilih Sesi')
                ->options(function (callable $get) {
                    $courseId = $get('course_id');
                    if (!$courseId) return [];
                    return LearningSession::where('course_id', $courseId)
                        ->pluck('title', 'id');
                })
                ->required(),

            TextInput::make('title')
                ->label('Judul Video')
                ->required(),

            TextInput::make('youtube_video_id')
                ->label('ID Video YouTube')
                ->required(),
            ]);
        }
    
     public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('title')->label('Judul'),
            TextColumn::make('course.title')->label('Kursus'),
            TextColumn::make('session.title')->label('Sesi'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
}
