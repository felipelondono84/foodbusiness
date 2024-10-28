<?php

namespace App\Filament\Supervisor\Resources\ManagementActivityResource\Pages;

use App\Filament\Supervisor\Resources\ManagementActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManagementActivity extends EditRecord
{
    protected static string $resource = ManagementActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
