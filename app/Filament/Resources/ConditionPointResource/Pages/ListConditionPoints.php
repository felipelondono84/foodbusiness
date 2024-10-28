<?php

namespace App\Filament\Resources\ConditionPointResource\Pages;

use App\Filament\Resources\ConditionPointResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConditionPoints extends ListRecords
{
    protected static string $resource = ConditionPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
