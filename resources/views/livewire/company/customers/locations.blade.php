<div>
 
   @if(!count($locations))
   <center>
      <div>
         <h4>Geen locaties aangemaakt bij deze klant relatie</h4>
         Er zijn geen locaties gevonden voor deze klant relatie.
         <br><br>
         <a href="/customer/location/{{ $debtor_id }}/create">
         <button  
            class="btn btn-soft-success   btn-sm">
            Locatie aanmaken
         </button>
      </a>

      </div>
   </center>
   @else
   <x-table>
      <x-slot name="head">
      <x-table.heading> </x-table.heading>
         <x-table.heading>Functie</x-table.heading>
         <x-table.heading>Naam</x-table.heading>
         <x-table.heading>Adres</x-table.heading>
         <x-table.heading>Postcode</x-table.heading>
         <x-table.heading>Plaats</x-table.heading>
         <x-table.heading> </x-table.heading>

      </x-slot>
      <x-slot name="body">
         @foreach ($locations as $location)
         <x-table.row wire:key="row-{{ $location->id }}">


         <x-table.cell>
                  <a class="d-flex align-items-center" href="./project.html">
                     @if($location->image)
                    <img class="avatar" src="/storage/{{$location->image}}"  >

                    @else
                    <img class="avatar" src="/assets/img/160x160/img2.jpg"  >

                    @endif

                
                  </a>
</x-table.cell>


            <x-table.cell>
    
               <div style="width: 80px;">
                  @if($location->building_type)
                  <span
                     class=" badge bg-soft-primary text-primary ">{{$location->building_type}}</span>
                    
                  @endif
               </div>

            </x-table.cell>

            <x-table.cell>
               <a href="/locations/{{$location->id}}">
                  {{$location->name}}

               </a>

            </x-table.cell>
            <x-table.cell>
               {{$location->address}}
            </x-table.cell>
            <x-table.cell>
               {{$location->zipcode}}
            </x-table.cell>
            <x-table.cell>

               {{$location->place}}
            </x-table.cell>

            <x-table.cell>

            
      
            <div style="float: right">
               <a href="/location/edit/{{$location->id}}">
                  <button style="float: right"
                  class="btn btn-ghost-warning text-warning btn-icon btn-sm rounded-circle"                                  >
                  <i class="bi bi-pencil"></i>
                  </a>      </x-table.cell>

            </div>


         </x-table.row>
         @endforeach
      </x-slot>
   </x-table>
   <div style="padding-top: 10px; float: right">

   </div>
   @endif

   <!-- CrudModal  -->
 
</div>

<script>
   document.addEventListener('livewire:init', () => {
      Livewire.on('close-crud-modal', (event) => {
         $('#crudModal').modal('hide');
      });
   });
</script>