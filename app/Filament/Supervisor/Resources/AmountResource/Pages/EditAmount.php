<?php

namespace App\Filament\Supervisor\Resources\AmountResource\Pages;

use App\Filament\Supervisor\Resources\AmountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmount extends EditRecord
{
    protected static string $resource = AmountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
