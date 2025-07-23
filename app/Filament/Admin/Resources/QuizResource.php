<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\QuizResource\Pages;
use App\Filament\Admin\Resources\QuizResource\RelationManagers;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\QuizResource\RelationManagers\QuestionsRelationManager;



class QuizResource extends Resource
{

    public static function shouldRegisterNavigation(): bool
{
    return false;
}

    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Course Management';
    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('course_id')
                ->label('Kursus')
                ->options(Course::pluck('title', 'id'))
                ->reactive(),

            Select::make('learning_session_id')
                ->label('Sesi Belajar')
                ->options(function (callable $get) {
                    $courseId = $get('course_id');
                    return $courseId
                        ? LearningSession::where('course_id', $courseId)->pluck('title', 'id')
                        : [];
                })
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
         //   'index' => Pages\ListQuizzes::route('/'),
          //  'create' => Pages\CreateQuiz::route('/create'),
           // 'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
