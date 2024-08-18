<div class="container-fluid">
   <div class="page-header">
      <div class="row align-items-center">
         <div class="col">
            <img src="/assets/img/ico/users.png" class = "pageico">
            <h1 class="page-header-title"> Liften overzicht 
               @if($ifArchive)
                  <span class = "text-danger">(Ge-archiveerd)</span>
               @endif 

            <span class="text-muted fw-normal ms-2">({{ $elevators->Total()}})</h1>
            <span class=" mb-2 text-muted">  Toon pagina <b> {{ $elevators->currentPage()}} </b> van <b> {{ $elevators->lastPage()}} </b> met huidige filters <b> {{ $elevators->Total()}} </b> liften gevonden</span>
         </div>
         <div class="col-auto">
            <button type="button" onclick="history.back()" style=" width: 150px; " class="btn btn-soft-primary" >
            Terug
            </button>
            <a href = "/company/elevator/create">
            <button type="button"   style=" width: 150px; " class="btn btn-soft-success" >
            Toevoegen
            </button></a>
         </div>
      </div>
   </div>
   <div class="row pt-3">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header card-header-content-md-between bg-light">
               <div class="mb-2 mb-md-0">
                  <!-- Search -->
                  <div class="input-group input-group-merge">
                     <input type="text"  wire:model.live="filters.search" class="js-form-search form-control" placeholder="Zoeken op trefwoord..."
                        data-hs-form-search-options='{
                        "clearIcon": "#clearIcon2",
                        "defaultIcon": "#defaultClearIconToggleEg"
                        }'>
                     <button type="button" class="input-group-append input-group-text">
                     <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                     <i id="defaultClearIconToggleEg" class="bi-search" style="display: none;"></i>
                     </button>
                  </div>
                  <!-- End Search -->
               </div>
               <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                  <div class="d-flex align-items-center justify-content-center">
                     <div wire:loading.delay class="loading_indicator_small"></div>
                  </div>
                  <!-- Datatable Info -->
                  <div id="datatableCounterInfo" style="display: none;">
                     <div class="d-flex align-items-center">
                        <span class="fs-5 me-3">
                        <span id="datatableCounter">0</span>
                        Selected
                        </span>
                        <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                        <i class="bi-trash"></i> Delete
                        </a>
                     </div>
                  </div>
                  <!-- End Datatable Info -->
                  <!-- Dropdown -->
                  <!-- <div class="dropdown">
                     <button type="button" class="btn btn-white  dropdown-toggle w-100" id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-download me-2"></i> Exporteren</button>
                     <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown" style="">
                        <span class="dropdown-header">Opties</span>
                        <a wire:click="export('xlsx')" id="export-excel" class="dropdown-item" href="javascript:;">
                        Excel
                        </a>
                        <a id="export-csv" wire:click="export('csv')" class="dropdown-item" href="javascript:;">
                        .CSV
                        </a>
                        <a id="export-pdf" wire:click="export('pdf')" class="dropdown-item" href="javascript:;">
                        PDF
                        </a>
                        <a id="export-pdf" wire:click="export('html')" class="dropdown-item" href="javascript:;">
                        HTML
                        </a>
                     </div>
                     </div> -->
                  <!-- End Dropdown -->
                  <!-- Dropdown -->
                  <div class="dropdown">
                     <button type="button" class="btn btn-white btn-sm w-100"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters" aria-controls="offcanvasFilters">
                     <i class="bi-filter me-1"></i>   Filter
                     <span class="badge bg-soft-dark text-dark rounded-circle ms-1">{{$cntFilters}}</span>
                     </button>
                  </div>
                  <!-- End Dropdown -->
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div>
                     <div class="row">
                        <div  class = "loading"   wire:loading>
                           <img style = "height: 190px" src="/assets/img/loading_elevator.gif">
                           <br>
                           <span class="text-muted">Bezig met gegevens ophalen</span>
                        </div>
                        <div wire:loading.remove>
                           @if($selectPage && $elevators->count() <> $elevators->total() ) @unless($selectAll)
                           <div class = "pb-3">
                              Er zijn <strong> {{$elevators->count()}}</strong> resultaten geselecteerd wil je alle <strong> {{$elevators->total()}}</strong> resultaten selecteren ?
                              <span class="text-primary" style="cursor: pointer;" wire:click="selectAllFromDropdown">
                              Selecteer alle resultaten
                              </span>
                           </div>
                           @else
                           <div class = "pb-3">
                              {{$elevators->total()}} resultaten geselecteerd
                           </div>
                           @endif @else
                           @endif
                           @if($this->cntFilters)
                           <div class = "pb-3">
                              <i class="bi-filter me-1"></i>      Resultaten gefilterd met @if($this->cntFilters <= 1) 1 filter @else {{$this->cntFilters}} filters @endif</>
                              <span wire:click = "resetFilters()" style = "cursor: pointer" class = "text-primary">Wis alle filters</span>
                           </div>
                           @endif
                           <x-table>
                              <x-slot name="head">
                                 <x-table.heading></x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('unit_no')" :direction="$sortDirection">Nummer</x-table.heading>
                                 <x-table.heading>
                                    Nobonummer
                                 </x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('elevator.address_id')" :direction="$sortDirection">Complex</x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('relation_id')" :direction="$sortDirection">Eigenaar  </x-table.heading>
                                 <x-table.heading>Beheerder</x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('inspection_company_id')" :direction="$sortDirection">Keuring instantie</x-table.heading>
                                 <x-table.heading>Onderhoudspartij</x-table.heading>
                                 <x-table.heading>
                                    <center>Storingen</center>
                                 </x-table.heading>
                                 <x-table.heading></x-table.heading>
                              </x-slot>
                              <x-slot name="body">
                                 @forelse ($elevators as $elevator)
                                 <x-table.row onclick="window.location='/company/elevator/show/{{$elevator->id}}'">
                                    <x-table.cell>
 
                       

                                       @if($elevator->status_id=='2')
                                       <i class="fa-solid fa-building-circle-xmark text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Lift buiten gebruik"></i>
                                       @endif
                                       @if($elevator->status_id=='1')
                                       <i class="fa-solid fa-building-circle-check text-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Operationeel"></i>
                                       @endif
                                       @if($elevator->management_elevator)
                                       <span class = "text-primary"  > <i class="fa-solid fa-user-gear" data-bs-toggle="tooltip" data-bs-placement="right" title="Beheerslift"> </i>   </span>
                                       @endif
                                       @if ($elevator->countIncident)
                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 text-red-600 animate-ping ">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                       </svg>
                                       @endif  

                                                 
                                    @if($elevator->archive)
                           <span class="badge bg-soft-danger text-danger py-2">Ge-archiveerd</span>
 @endif

                                    </x-table.cell>
                                    <x-table.cell>
                                       {{ $elevator->unit_no }} {{ $elevator->disapprovedState }} @if ($elevator->disapprovedState != null)								@if($management_elevator)
                                       <span class = "badge badge-soft-primary py-2 m-0" style = "float: left">LVA Liftbeheer</span>
                                       @endif
                                       <br> <span class="inline-flex items-center rounded-full bg-pink-100 px-2.5 py-0.5 text-xs font-medium text-pink-800">
                                       Afgekeurd op:
                                       {{ Carbon\Carbon::parse($elevator->check_valid_date)->format('d-m-Y') }}</span> 
                                       @endif
                                    </x-table.cell>
                                    <x-table.cell>
                                       {{ $elevator->nobo_no}}
                                    </x-table.cell>
                                    <x-table.cell>
                              @if ($elevator->address) @if ($elevator->address->name) <b>{{ $elevator->address->name }}</b>


                                       <br> @endif <small>
                                       {{ $elevator->address->address }}, @if ($elevator->address->housenumber)
                                       {{ $elevator->address->housenumber }},
                                       @endif @if ($elevator->address->zipcode)
                                       {{ $elevator->address->zipcode }},
                                       @endif {{ $elevator->address->place }}
                                       @endif
                                       @if($elevator->description)
                                       <br>
                                       {{$elevator->description}}
                                       @endif
                                       </small> 
                        </div>
                        </x-table.cell>
                        <x-table.cell> @if ($elevator->address) {{ $elevator->address?->customer?->name }} @else <span class="badge bg-soft-info text-info">Geen eigenaar  </span> @endif </x-table.cell>
                        <x-table.cell> @if ($elevator?->address) @if ($elevator?->address?->management?->name) {{$elevator?->address?->management?->name}} @endif @endif </x-table.cell>
                        <x-table.cell> @if ($elevator->inspection_company_id) {!! $elevator->inspectioncompany?->name !!} @endif </x-table.cell>
                        <x-table.cell> @if ($elevator->maintenancecompany) {{ $elevator->maintenancecompany->name }} @endif </x-table.cell>
                        <x-table.cell>
                        <center> {{ count($elevator->incidents) }} </center>
                        </x-table.cell>
                        <x-table.cell>
                        <div style = "float: right">
                        <div class="dropdown">
                        <button type="button" onclick="window.location='/company/incident/show/{{ $elevator->id }}'"  class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-eye"></i>
                        </button>
                        </x-table.cell>                                </div>
                        </x-table.row> @empty
                        <x-table.row>
                        <x-table.cell colspan="9">
                        <div class="flex justify-center items-center space-x-2">
                        <span class="font-medium py-8 text-cool-gray-400 text-xl">Geen liften gevonden met de huidige
                        filters...</span>
                        </div>
                        </x-table.cell>
                        </x-table.row> @endforelse </x-slot>
                        </x-table>
                        <center>
                        <div style="padding-top: 10px; float: right">
                        {{ $elevators->links() }}
                        </div>
                        </center>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="offcanvas offcanvas-end" wire:ignore tabindex="-1" id="offcanvasFilters" aria-labelledby="offcanvasRightLabel">
               <div class="offcanvas-header">
                  <h5 id="offcanvasRightLabel"><i class="bi-filter me-1"></i> Filter</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
               </div>
               <div class="offcanvas-body">
                  <div class = "row" style = "">
                     <div class="col-md-6"><button class="btn btn-white btn-sm w-100 " wire:click ="resetFilters()" >Wis filters</button>
                     </div>
                     <div class="col-md-6">
                        <button  data-bs-dismiss="offcanvas" aria-label="Close"  class="w-100 btn btn-primary btn-sm" >Sluiten</button>
                     </div>
                  </div>
                  <small class="text-cap text-body pt-3">Trefwoord</small>
                  <input  type="search" wire:model.live="filters.search" class="form-control" placeholder="Zoek op trefwoord" aria-label="Zoek op trefwoord">
                  <small class="text-cap text-body pt-3">Plaats</small>
                  <div class="tom-select-custom " wire:ignore >
                     <select style = "height: 40px;" class="js-select form-select " wire:model.live="filters.place" multiple data-hs-tom-select-options='{
                        "placeholder": "Alle plaatsen"
                        }'>
                        @foreach($addresses as $address)
                        <option value="{{$address->place}}">{{$address->place}}</option>
                        @endforeach
                     </select>
                  </div>
                  <small class="text-cap text-body pt-3">Beheerder</small>
                  <div class="tom-select-custom " wire:ignore>
                     <select class="js-select form-select " wire:model.live="filters.management_id" multiple data-hs-tom-select-options='{
                        "placeholder": "Alle beheerders"
                        }'>
                        @foreach($managements as $management)
                        <option value="{{$management->id}}">{{$management->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <small class="text-cap text-body pt-3">Eigenaar</small>
                  <div class="tom-select-custom " wire:ignore>
                     <select class="js-select form-select " wire:model.live="filters.customer_id" multiple data-hs-tom-select-options='{
                        "placeholder": "Alle Eigenaren"
                        }'>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <small class="text-cap text-body pt-3">keuringsinstanties</small>
                  <div class="tom-select-custom " wire:ignore>
                     <select class="js-select form-select"   wire:model.live="filters.inspection_company_id" multiple     data-hs-tom-select-options='{
                     "placeholder": "Alle keuringsinstanties"
                     }'>
                     @foreach($inspectionCompanys as $item)
                     <option value="{{$item->id}}">{{$item->name}}</option>
                     @endforeach
                     </select>
                  </div>
                  <small class="text-cap text-body pt-3">Onderhoudspartijen</small>
                  <div class="tom-select-custom " wire:ignore>
                     <select class="js-select form-select " autocomplete="off"  wire:model.live="filters.maintenance_company_id"    multiple     data-hs-tom-select-options='{
                        "placeholder": "Alle Onderhoudspartijen"
                        }'>
                        @foreach($maintenanceCompanys as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                     </select>
                  </div>

                  <small class="text-cap text-body pt-3">Bedrijf</small>
                  <div class="tom-select-custom " wire:ignore>
                     <select class="js-select form-select " autocomplete="off"  wire:model.live="filters.management_elevator"    multiple     data-hs-tom-select-options='{
                        "placeholder": "Alle liften"
                        }'>
                         
                        <option value="1">LVA Liftbeheer</option>
                        <option value="0">LVA Liftadvies</option>
                      
                     </select>
                  </div>
            
                


               </div>
            </div>
         </div>
      </div>
   </div>
</div>