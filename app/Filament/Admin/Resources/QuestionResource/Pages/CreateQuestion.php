<?php

namespace App\Filament\Admin\Resources\QuestionResource\Pages;

use App\Filament\Admin\Resources\QuestionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

    protected function afterCreate(): void
    {
        $data = $this->form->getState();
        $question = $this->record;

    
        \App\Filament\Admin\Resources\QuestionResource::syncAnswers($question, $data);
    }
}