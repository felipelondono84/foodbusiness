<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

use App\Models\Timesheet;
use App\Models\User;
use Carbon\Carbon;

class PersonalWidgetStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total time Activity', $this->getTotalWork(Auth::user())),
            // Stat::make('Bounce rate', '21%'),
            //Stat::make('Average time on page', '3:12'),
        ];

    }

    protected function getTotalWork(User $user){
        $timeSheets = Timesheet::where('users_id', $user->id)
            ->where('type','work')->get();
            $sumHours = 0;
            foreach ($timeSheets as $timesheet) {
                $startTime = Carbon::parse($timesheet->day_in);
                $finishTime = Carbon::parse($timesheet->day_out);

                $totalDuration = $finishTime->diffInSeconds($startTime);
                
                $sumHours = $sumHours + $totalDuration;
                
            }    
            $tiempoformato = gmdate("H:i:s",$sumHours);
            return $tiempoformato;
    }
}
