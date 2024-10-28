<?php

namespace App\Filament\Resources\SheduleResource\Pages;

use App\Filament\Resources\SheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShedules extends ListRecords
{
    protected static string $resource = SheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
