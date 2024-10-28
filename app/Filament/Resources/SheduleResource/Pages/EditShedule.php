<?php

namespace App\Filament\Resources\SheduleResource\Pages;

use App\Filament\Resources\SheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShedule extends EditRecord
{
    protected static string $resource = SheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
