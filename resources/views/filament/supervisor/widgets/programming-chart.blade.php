<x-filament-widgets::widget>
   <style>
       .programming-widget {
           padding: 1.5rem;
           background-color: #f8f9fa;
           border-radius: 8px;
           border: 1px solid #e0e0e0;
       }

       .programming-widget h2 {
           font-size: 1.5rem;
           color: #333;
           margin-bottom: 1rem;
       }

       .programming-widget ul {
           list-style: none;
           padding: 0;
           margin: 0;
       }

       .programming-widget li {
           padding: 0.5rem 0;
           border-bottom: 1px solid #ddd;
           display: grid;
           grid-template-columns: 2fr 2fr 1fr;
           gap: 1rem;
           align-items: center;
       }

       .programming-widget li:last-child {
           border-bottom: none;
       }

       .programming-widget li span {
           font-weight: bold;
           color: #007bff;
       }

       .programming-widget .company-name {
           color: #28a745;
           font-weight: bold;
       }

       .programming-widget .date {
           font-style: italic;
           color: #555;
           text-align: right;
       }
   </style>

   <x-filament::section class="programming-widget">
       <h2>Programming Data</h2>
       <ul>
           @foreach ($this->programmingData as $program)
               <li>
                   <span>{{ $program->name }}</span>
                   <span class="company-name">{{ $program->companies->name ?? 'N/A' }}</span>
                   <span class="date">{{ \Carbon\Carbon::parse($program->date)->format('d M Y') }}</span>
               </li>
           @endforeach
       </ul>
   </x-filament::section>
</x-filament-widgets::widget>
