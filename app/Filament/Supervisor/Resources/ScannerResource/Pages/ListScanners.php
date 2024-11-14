<?php

namespace App\Filament\Supervisor\Resources\ScannerResource\Pages;

use App\Filament\Supervisor\Resources\ScannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScanners extends ListRecords
{
    protected static string $resource = ScannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
