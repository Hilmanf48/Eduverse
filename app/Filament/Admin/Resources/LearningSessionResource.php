<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LearningSessionResource\Pages;
use App\Filament\Admin\Resources\LearningSessionResource\RelationManagers;
use App\Models\LearningSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Admin\Resources\LearningSessionResource\RelationManagers\QuizRelationManager;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;


class LearningSessionResource extends Resource
{
    protected static ?string $model = LearningSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Course Management';
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('course_id')
                ->label('Pilih Kursus')
                ->options(\App\Models\Course::pluck('title', 'id'))
                ->required(),

            Forms\Components\TextInput::make('title')
                ->label('Judul Sesi')
                ->required(),

            Forms\Components\TextInput::make('order')
                ->label('Urutan')
                ->numeric()
                ->required(),

            Forms\Components\Toggle::make('is_published')
                ->label('Aktifkan Sesi?')
                ->default(false),
        ]);
    }


    public static function table(Table $table): Table
    {
         return $table
        ->columns([
            TextColumn::make('title')->label('Judul Sesi'),
            TextColumn::make('course.title')->label('Kursus'),
            
            ToggleColumn::make('is_published')
                ->label('Aktifkan Sesi')
                ->sortable()
                ->afterStateUpdated(function ($record, $state) {
                    $record->is_published = $state;
                    $record->save();
                }),
            
            IconColumn::make('is_published')
                ->boolean()
                ->label('Status'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
            
    }

    public static function getRelations(): array
    {
        return [
            QuizRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLearningSessions::route('/'),
            'create' => Pages\CreateLearningSession::route('/create'),
            'edit' => Pages\EditLearningSession::route('/{record}/edit'),
        ];
    }
}
