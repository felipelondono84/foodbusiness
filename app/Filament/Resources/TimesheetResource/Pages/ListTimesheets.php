<?php

namespace App\Filament\Resources\TimesheetResource\Pages;

use App\Filament\Resources\TimesheetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use App\Models\Timesheet;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use App\Models\Activity;

class ListTimesheets extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        $lastTimesheet = Timesheet::where('users_id', Auth::user()->id)->orderBy('id','desc')->first();
        return [
            Action::make('inwork')
                ->label('Start Activity')
                ->color('success')
                ->requiresConfirmation()
                ->icon('heroicon-m-pencil-square')
                ->form([
                    Select::make('activities_id')
                        ->label('Select Activity')
                        ->options(Activity::all()->pluck('name', 'id')) // Traer actividades de la relación
                        ->required(),
                ])
                ->action(function (array $data) {
                    $user = Auth::user();
                    $timesheet = new Timesheet();
                    $timesheet->activities_id = $data['activities_id'];
                    $timesheet->users_id = $user->id;
                    $timesheet->day_in = Carbon::now();
                    // $timesheet->day_out = Carbon::now();
                    $timesheet->type = 'work';
                    $timesheet->save();

                }),
            Action::make('Stopwork')
                ->label('End Activity')
                ->color('info')
                ->requiresConfirmation()
                ->icon('heroicon-m-pencil-square')
                ->action(function()use($lastTimesheet){
                    $lastTimesheet->day_out = Carbon::now();
                    $lastTimesheet->save();

                }),    
            
            Actions\CreateAction::make(),
            
        ];
    }
}
