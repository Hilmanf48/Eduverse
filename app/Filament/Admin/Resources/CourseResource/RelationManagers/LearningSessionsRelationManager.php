<?php

namespace App\Filament\Admin\Resources\CourseResource\RelationManagers;

use App\Models\LearningSession;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class LearningSessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sessions';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Sesi')
                    ->required()
                    ->maxLength(255),

                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul'),
                TextColumn::make('order')->label('Urutan'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
