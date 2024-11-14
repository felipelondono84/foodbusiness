<?php

namespace App\Filament\Supervisor\Resources\AmountResource\Pages;

use App\Filament\Supervisor\Resources\AmountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAmounts extends ListRecords
{
    protected static string $resource = AmountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
