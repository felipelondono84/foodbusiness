<?php

namespace App\Filament\Supervisor\Resources\ProgrammingResource\Pages;

use App\Filament\Supervisor\Resources\ProgrammingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProgramming extends CreateRecord
{
    protected static string $resource = ProgrammingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
        
    
        return $data;
    }
}
