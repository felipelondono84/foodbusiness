<?php

namespace App\Filament\Supervisor\Widgets;

use Filament\Widgets\Widget;
use App\Models\Requirement;

class Requeriments extends Widget
{
    protected static string $view = 'filament.supervisor.widgets.requeriments';

    public $requerimentData; // Define la propiedad para usarla en la vista

    public function mount()
    {
        // Cargar datos junto con las relaciones companies y punto
        //$this->requerimentData = Requirement::with(['companies', 'punto'])->get();

        $this->requerimentData = Requirement::with('companies')->get();
        
    }
}

