<?php

namespace App\Filament\Supervisor\Resources\ProgrammingResource\Pages;

use App\Filament\Supervisor\Resources\ProgrammingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgrammings extends ListRecords
{
    protected static string $resource = ProgrammingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
