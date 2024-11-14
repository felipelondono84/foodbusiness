<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChecklistItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $items = [
            'Apertura confirmada',
            'Verificación de condiciones del clima',
            'Verificación de aplicaciones de entregas',
        ];
    
        foreach ($items as $item) {
            ChecklistItem::create(['name' => $item]);
        }
    }
}
