<?php

namespace App\Filament\Resources\TypeCorrespondenceResource\Pages;

use App\Filament\Resources\TypeCorrespondenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeCorrespondence extends EditRecord
{
    protected static string $resource = TypeCorrespondenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
