<div>
   <div class="page-header  my-3">


   <div class="row">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">Tovoegen</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">  
            <button wire:loading.attr="disabled" type="button" class="btn    btn-soft-success  bnt-ico btn-120" data-bs-toggle="modal"
                data-bs-target="#crudModal">
               Toevoegen
                </button> <button type="button" onclick="history.back()" class="  btn btn-soft-secondary    btn-icon    ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>

 
   </div>
  


 

   <div class="row ">
      <div class="col-xl-12">
         <div class="card  ">
         <div class="card-header  ">

         <form class = "float-start">
            <div class="input-group input-group-merge ">
               <input type="text" wire:model.live="filters.keyword" class="js-form-search form-control"
                  placeholder="Zoeken op trefwoord..." data-hs-form-search-options="{
                     &quot;clearIcon&quot;: &quot;#clearIcon2&quot;,
                     &quot;defaultIcon&quot;: &quot;#defaultClearIconToggleEg&quot;
                     }">
               <button type="button" class="input-group-append input-group-text">
                  <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                  <i id="defaultClearIconToggleEg" class="bi-search" style="display: block; opacity: 1.03666;"></i>
               </button>
            </div>
         </form> 

</div>
            <div class="card-body ">

 

               <div class="row ">
                  <div class="loading" wire:loading>
                     <img style="height: 190px" src="/assets/img/loading_elevator.gif">
                     <br>
                     <span class="text-muted">Bezig met gegevens ophalen</span>
                  </div>
                  <div class="col-md-12 " wire:loading.remove>
                     
                     <div wire:loading.remove>
                        @if($items->count())
                        <x-table >
                           <x-slot name="head">
                              <x-table.heading sortable wire:click="sortBy('name')">Naam</x-table.heading>
                 
                           </x-slot>
                           <x-slot name="body">
                              @foreach ($items as $item)
                              <x-table.row onclick="location='/supplier/{{$item->id}}'" wire:key="row-{{ $item->id }}">
                                 <x-table.cell >
                                 <a href = "/knowledgebase//article/{{$item->slug}}">   {{$item->name}}</a>
                                 </x-table.cell>
             
                           
                        
                              </x-table.row>
                              @endforeach
                           </x-slot>
                        </x-table>
                        @else
                        @include('layouts.partials._empty')
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix pt-3  ">
            <div class="float-end wire:loading.remove"> @if($items->links())
               {{ $items->links() }}
               @endif
            </div>
         </div>
         <div class="offcanvas offcanvas-end" wire:ignore tabindex="-1" id="offcanvasFilters"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
               <h5 id="offcanvasRightLabel"><i class="bi-filter me-1"></i> Filters</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
               <small class="text-cap text-body pt-3">Trefwoord</small>
               <input type="search" wire:model.live="filters.keyword" class="form-control"
                  placeholder="Zoek op trefwoord" aria-label="Zoek op trefwoord">
               <small class="text-cap text-body pt-3">Plaats</small>
               <div class="row pt-4" style="">
                  <div class="col-md-6"><button class="btn btn-white btn-sm w-100 " wire:click="resetFilters()">Wis
                     filters</button>
                  </div>
                  <div class="col-md-6">
                     <button data-bs-dismiss="offcanvas" aria-label="Close"
                        class="w-100 btn btn-primary btn-sm">Sluiten</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   
</div>
 