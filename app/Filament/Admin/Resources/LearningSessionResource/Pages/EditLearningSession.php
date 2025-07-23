<?php

namespace App\Filament\Admin\Resources\LearningSessionResource\Pages;

use App\Filament\Admin\Resources\LearningSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLearningSession extends EditRecord
{
    protected static string $resource = LearningSessionResource::class;


    

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
