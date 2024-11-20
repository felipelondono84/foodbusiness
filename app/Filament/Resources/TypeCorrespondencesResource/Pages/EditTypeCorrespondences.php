<?php

namespace App\Filament\Resources\TypeCorrespondencesResource\Pages;

use App\Filament\Resources\TypeCorrespondencesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeCorrespondences extends EditRecord
{
    protected static string $resource = TypeCorrespondencesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
