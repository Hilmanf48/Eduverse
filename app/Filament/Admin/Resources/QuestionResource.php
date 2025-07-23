<?php

namespace App\Filament\Admin\Resources;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\LearningSession;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use App\Models\Answer;
use App\Filament\Admin\Resources\QuestionResource\Pages;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Course Management';

    public static function form(Form $form): Form
    {
            return $form->schema([
        Select::make('course_id')
            ->label('Pilih Kursus')
            ->options(Course::pluck('title', 'id'))
            ->reactive()
            ->afterStateUpdated(fn ($set) => $set('learning_session_id', null)),

        Select::make('learning_session_id')
            ->label('Pilih Sesi')
            ->options(function ($get) {
                $courseId = $get('course_id');
                return $courseId
                    ? LearningSession::where('course_id', $courseId)->where('is_published', true)->pluck('title', 'id')
                    : [];
            })
            ->reactive()
            ->afterStateUpdated(fn ($set) => $set('quiz_id', null)),

        Select::make('quiz_id')
            ->label('Pilih Kuis')
            ->options(function ($get) {
                $sessionId = $get('learning_session_id');
                return $sessionId
                    ? Quiz::where('learning_session_id', $sessionId)->pluck('title', 'id')
                    : [];
            })
            ->required(),

        Textarea::make('question_text')->label('Pertanyaan')->required(),

        
        Repeater::make('answers')
            ->relationship()
            ->schema([
                TextInput::make('answer_text')->label('Jawaban')->required(),
                Checkbox::make('is_correct')->label('Jawaban Benar?'),
            ])
            ->label('Pilihan Jawaban')
            ->columns(2)
            ->defaultItems(4)
            ->required(),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
        Tables\Columns\TextColumn::make('question_text')->label('Pertanyaan'),
        Tables\Columns\TextColumn::make('quiz.title')->label('Kuis'),
        Tables\Columns\TextColumn::make('learningSession.title')->label('Sesi'),
        Tables\Columns\TextColumn::make('course.title')->label('Kursus'),
    ])
    ->actions([
        Tables\Actions\EditAction::make(),
    ])
    ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
    ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
