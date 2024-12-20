<?php

namespace App\Filament\Resources\ManagementActivityResource\Pages;

use App\Filament\Resources\ManagementActivityResource;
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
