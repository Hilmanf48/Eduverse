<?php

namespace App\Filament\Admin\Resources\LearningSessionResource\RelationManagers;


use App\Models\Quiz;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;

class QuizRelationManager extends RelationManager
{
    protected static string $relationship = 'quizzes';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Forms\Form $form): Forms\Form
    {
    return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Kuis')
                    ->required(),
                Select::make('course_id')
                    ->label('Course')
                    ->relationship('course', 'title')
                    ->required(),

        Forms\Components\Textarea::make('description')
            ->label('Deskripsi')
            ->nullable(),
    ]);
}

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul Kuis'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
    public function canCreate(): bool
{
    return true;
}

public static function canViewAny(): bool
{
    return true;
}
}
