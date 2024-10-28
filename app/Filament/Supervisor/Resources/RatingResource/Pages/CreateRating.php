<?php

namespace App\Filament\Supervisor\Resources\RatingResource\Pages;

use App\Filament\Supervisor\Resources\RatingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateRating extends CreateRecord
{
    protected static string $resource = RatingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
        
    
        return $data;
    }
}
