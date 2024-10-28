<?php

namespace App\Filament\Resources\ConditionPointResource\Pages;

use App\Filament\Resources\ConditionPointResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConditionPoint extends EditRecord
{
    protected static string $resource = ConditionPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
