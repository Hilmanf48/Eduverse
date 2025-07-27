<?php

namespace App\Filament\Admin\Resources\QuestionResource\Pages;

use App\Filament\Admin\Resources\QuestionResource;
use Filament\Resources\Pages\EditRecord;

class EditQuestion extends EditRecord
{
    protected static string $resource = QuestionResource::class;

    protected function afterSave(): void
    {
        $data = $this->form->getState();
        $question = $this->record;

        
        $question->answers()->delete();

        \App\Filament\Admin\Resources\QuestionResource::syncAnswers($question, $data);
    }
}