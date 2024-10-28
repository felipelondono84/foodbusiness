<?php

namespace App\Filament\Supervisor\Resources\ManagementActivityResource\Pages;

use App\Filament\Supervisor\Resources\ManagementActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManagementActivities extends ListRecords
{
    protected static string $resource = ManagementActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
