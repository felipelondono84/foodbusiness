<?php

namespace App\Filament\Supervisor\Widgets;

use Filament\Widgets\Widget;
use App\Models\Programming;

class ProgrammingChart extends Widget
{
    protected static string $view = 'filament.supervisor.widgets.programming-chart';

    public $programmingData; // Define la propiedad para usarla en la vista

    public function mount()
    {
        // Cargar los datos del modelo junto con la relación "companies" y asignarlos a la propiedad
        $this->programmingData = Programming::with('companies')->get();
    }
}

