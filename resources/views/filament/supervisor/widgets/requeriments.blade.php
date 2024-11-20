<x-filament-widgets::widget>
   <style>
       .requeriments-widget {
           padding: 1.5rem;
           background-color: #f9f9f9;
           border-radius: 8px;
           border: 1px solid #e0e0e0;
       }

       .requeriments-widget h2 {
           font-size: 1.5rem;
           color: #333;
           margin-bottom: 1rem;
       }

       .requeriments-widget ul {
           list-style: none;
           padding: 0;
           margin: 0;
       }

       .requeriments-widget li {
           padding: 0.5rem 0;
           border-bottom: 1px solid #ddd;
           display: grid;
           grid-template-columns: 3fr 1fr;
           gap: 1rem;
           align-items: center;
       }

       .requeriments-widget li:last-child {
           border-bottom: none;
       }

       .requeriments-widget .status {
           font-weight: bold;
           padding: 0.5rem 1rem;
           border-radius: 12px;
           text-align: center;
           text-transform: capitalize;
       }

       .status-pendiente {
           background-color: #fdecea;
           color: #b71c1c;
       }

       .status-finish {
           background-color: #e8f5e9;
           color: #1b5e20;
       }

       .requeriments-widget .empty {
           text-align: center;
           font-style: italic;
           color: #777;
       }
   </style>

   <x-filament::section class="requeriments-widget">
       <h2>Status of Requirements</h2>
       <ul>
           @forelse ($requerimentData as $requirement)
            <li>
                <div>
                    <p><strong>Descripción:</strong> {{ $requirement->description }}</p>
                    <p><strong>Compañía:</strong> {{ $requirement->companies->name ?? 'Sin compañía' }}</p>
                    <p><strong>Punto:</strong> {{ $requirement->punto->nombre ?? 'Sin compañía' }}</p>
                    <!-- Mostrar puntos relacionados -->
                    
                </div>
                <span class="status {{ $requirement->status === 'pending' ? 'status-pendiente' : '' }} 
                                   {{ $requirement->status === 'finish' ? 'status-finish' : '' }}">
                    {{ ucfirst($requirement->status) }}
                </span>
            </li>
        @empty
            <li class="empty">No hay requerimientos disponibles.</li>
        @endforelse

    
            
       </ul>
   </x-filament::section>
</x-filament-widgets::widget>

