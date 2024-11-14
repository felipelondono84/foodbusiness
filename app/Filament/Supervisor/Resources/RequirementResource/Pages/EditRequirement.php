<?php

namespace App\Filament\Supervisor\Resources\RequirementResource\Pages;

use App\Filament\Supervisor\Resources\RequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequirement extends EditRecord
{
    protected static string $resource = RequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
