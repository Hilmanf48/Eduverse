<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LessonResource\Pages;
use App\Filament\Admin\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Course; 
use App\Models\LearningSession;



class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Course Management';
    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('session_id')
                ->label('Sesi')
                ->relationship('session', 'title')
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('title')
                ->label('Judul Video')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('youtube_video_id')
                ->label('YouTube Video ID')
                ->helperText('Masukkan hanya ID video, bukan URL')
                ->required()
                ->regex('/^[a-zA-Z0-9_-]{11}$/')
                ->maxLength(11),

            Forms\Components\TextInput::make('order')
                ->label('Urutan ke-')
                ->numeric()
                ->required(),
        ]);
}

    public static function table(Table $table): Table
    {
         return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')->label('Judul'),
            Tables\Columns\TextColumn::make('session.title')->label('Sesi'),
            Tables\Columns\TextColumn::make('youtube_video_id')->label('YouTube ID'),
            Tables\Columns\TextColumn::make('order')->label('Urutan'),
        ])
        ->filters([])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
