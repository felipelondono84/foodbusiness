<?php

namespace App\Filament\Resources\TypeCorrespondenceResource\Pages;

use App\Filament\Resources\TypeCorrespondenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeCorrespondences extends ListRecords
{
    protected static string $resource = TypeCorrespondenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
