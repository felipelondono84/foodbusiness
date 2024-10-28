<?php

namespace App\Filament\Supervisor\Resources\ManagementActivityResource\Pages;

use App\Filament\Supervisor\Resources\ManagementActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateManagementActivity extends CreateRecord
{
    protected static string $resource = ManagementActivityResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['users_id'] = Auth::user()->id;
        
    
        return $data;
    }
}
