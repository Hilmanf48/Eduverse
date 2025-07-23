<?php

namespace App\Filament\Admin\Resources;

use App\Models\Testimonial;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Admin\Resources\TestimonialResource\Pages;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $navigationLabel = 'Testimonials';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('role'),
            TextInput::make('member_of'),
            Textarea::make('quote')->required(),
            FileUpload::make('image_path')
                ->image()
                ->directory('testimonials')
                ->imagePreviewHeight('100'),
            Select::make('user_id')
                ->label('Submitted by')
                ->relationship('user', 'name')
                ->searchable()
                ->preload(),
            Toggle::make('is_approved')->label('Approved'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')->label('Photo')->circular(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('role'),
                TextColumn::make('member_of'),
                TextColumn::make('quote')->limit(40)->wrap(),
                TextColumn::make('user.name')->label('User'),
                BooleanColumn::make('is_approved')->label('Approved'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved')->label('Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(fn (Testimonial $record) => $record->update(['is_approved' => true]))
                    ->requiresConfirmation()
                    ->visible(fn (Testimonial $record) => !$record->is_approved),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('bulk_approve')
                    ->label('Approve Selected')
                    ->action(fn ($records) => $records->each->update(['is_approved' => true]))
                    ->requiresConfirmation()
                    ->color('success'),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
