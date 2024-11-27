<?php

namespace App\Filament\Supervisor\Widgets;

use Filament\Widgets\Widget;
use App\Models\Rating;

class AverageRatingChart extends Widget
{
    protected static string $view = 'filament.supervisor.widgets.average-rating-chart';

//     protected function getData(): array
// {
//     // Obtener los promedios de calificación agrupados por usuario
//     $ratings = Rating::selectRaw('user_id, AVG(rating) as average_rating')
//         ->with('user:id,name') // Asegura que traemos los datos del usuario
//         ->groupBy('user_id')
//         ->get();

//     // Formatear los datos para la vista
//     $ratingsData = $ratings->map(function ($rating) {
//         return [
//             'user_name' => $rating->user->name ?? 'Usuario desconocido',
//             'average_rating' => $rating->average_rating,
//         ];
//     })->toArray();

//     return ['ratingsData' => $ratingsData];
//     }
}
