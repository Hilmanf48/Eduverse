<?php

namespace App\Filament\Admin\Resources;


use App\Models\Course;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use App\Filament\Admin\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\CourseResource\RelationManagers\QuizRelationManager;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\CourseResource;



class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Course';
    protected static ?string $pluralModelLabel = 'Course';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('category_id')
    ->label('Kategori Kursus')
    ->relationship('category', 'name') 
    ->required()
    ->searchable()
    ->preload(),

            TextInput::make('title')
                ->label('Course Title')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->label('Description')
                ->required()
                ->rows(5),

            FileUpload::make('image')
                ->label('Thumbnail')
                ->image()
                ->imagePreviewHeight('150')
                ->directory('thumbnails')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori'),
                Tables\Columns\ImageColumn::make('image')->label('Thumbnail'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['category'])
            ->withCount(['sessions', 'quizzes']);
    }
    protected function getRedirectUrl(): string
    {
        
        return $this->getResource()::getUrl('edit', ['record' => $this->record]) . '#relationManagerComponent-quizzes';

    }
}
