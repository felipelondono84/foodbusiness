<?php

namespace App\Filament\Resources\ManagementActivityResource\Pages;

use App\Filament\Resources\ManagementActivityResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use App\Models\Timesheet;
use App\Models\ManagementActivity;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ListManagementActivities extends ListRecords
{
    protected static string $resource = ManagementActivityResource::class;

    protected function getTableActions(): array
    {
        return [
            Action::make('startActivity')
                ->label('Start Activity')
                ->color('success')
                ->icon('heroicon-m-play')
                ->requiresConfirmation()
                ->action(function (ManagementActivity $record) {
                    // Obtener el usuario autenticado
                    $user = Auth::user();

                    // Crear un nuevo registro en Timesheet
                    $timesheet = new ManagementActivity();
                    $timesheet->activities_id = $record->id; // Usar la actividad de la fila actual
                    $timesheet->users_id = $user->id;
                    $timesheet->day_in = Carbon::now();
                    $timesheet->type = 'work';
                    $timesheet->save();
                }),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            // Define las columnas que deseas mostrar en la tabla
            // Por ejemplo, si deseas mostrar el nombre de la actividad
            Tables\Columns\TextColumn::make('name')
                ->label('Activity Name'),
                

            // Agrega otras columnas necesarias
        ];
    }
}
