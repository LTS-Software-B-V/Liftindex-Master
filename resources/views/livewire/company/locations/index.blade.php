<div class="container-fluid">


  <div class="page-header     ">
    <div class="row align-items-center ">
    <div class="col">

            <h1 class="page-header-title pt-3">  Locaties </h1>
 
    
         </div>
         <div class="col-auto pt-2">
            <form>
               <!-- Search -->
               <div class="input-group input-group-merge">
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
               <!-- End Search -->
            </form>
         </div>
         <div class="col-auto pt-2">
            <a href = "/location/add">
            <button type="button" class="btn   btn-primary  btn-sm" >
            <i class="bi bi-plus"></i> Toevoegen
            </button></a>
         </div>
      </div>
   </div>
   <div class="row pt-1">
      <div class="col-md-12"> 

         
                  <div>
                     <div class="row">
                        <div class="loading" wire:loading>
                           <img style="height: 190px" src="/assets/img/loading_elevator.gif">
                           <br>
                           <span class="text-muted">Bezig met gegevens ophalen</span>
                        </div>
                        <div wire:loading.remove>
                           @if($selectPage && $items->count() <> $items->total() ) @unless($selectAll)
                              <div class="pb-3">
                                 Er zijn <strong> {{$items->count()}}</strong> resultaten geselecteerd wil je alle
                                 <strong> {{$items->total()}}</strong> resultaten selecteren ?
                                 <span class="text-primary" style="cursor: pointer;" wire:click="selectAllFromDropdown">
                                    Selecteer alle resultaten
                                 </span>
                              </div>
                              @else
                              <div class="pb-3">
                                 {{$items->total()}} resultaten geselecteerd
                              </div>
                              @endif @else
                              @endif
                              @if($this->cntFilters)
                              <div class="alert alert-soft-warning" role="alert">
                                 <i class="bi-filter me-1"></i> Resultaten gefilterd met @if($this->cntFilters
                                 <= 1) 1 filter @else {{$this->cntFilters}} filters @endif< />
                                 <span wire:click="resetFilters()" style="cursor: pointer" class="text-primary">Wis alle
                                    filters</span>
                              </div>
                              @endif
                              @if($items->count())

                              <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 ">
                                 @foreach ($items as $location) <div class="col mb-3 mb-lg-5">
                                    <!-- Card -->
                                    <div class="card h-80">
                                       <div class="card-pinned">
                                          <div class="card-pinned-top-end">

                                             <!-- Dropdown -->
                                             <div class="dropdown">
                                                <button type="button"
                                                   class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle"
                                                   id="projectsGridDropdown8" data-bs-toggle="dropdown"
                                                   aria-expanded="false">
                                                   <i class="bi-three-dots-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end"
                                                   aria-labelledby="projectsGridDropdown8">
                                                   <a class="dropdown-item"
                                                      href="/location/edit/{{$location->id}}">Wijzigen </a>

                                                </div>
                                                <!-- End Dropdown -->
                                             </div>
                                          </div>
                                       </div>

                                       <!-- Body -->
                                       <div class="card-body text-center">
                                          <!-- Avatar -->
                                          <span class="avatar avatar-xxl avatar-4x3">

                                             @if($location->image)
                                             <img class="avatar-img " style="max-height: 90px"
                                                src="/storage/{{$location->image}}">

                                             @else
                                             <img class="avatar-img  " style="max-height: 90px"
                                                src="/assets/img/160x160/img2.jpg">

                                             @endif
                                          </span>

                                          <!-- End Avatar -->

                                          <h3 class="mb-2  pt-3">
                                             <a class="text-dark" href="/location/{{$location->slug}}"">
                            @if($location->name)
                            {{$location->name}} @else Geen naam @endif</a>
                            
                      </h3>
                      
                      
                      
                      <div class=" d-flex justify-content-between pb-3">
                                                <div class=" badge bg-soft-secondary text-secondary py-1">
                                                   {{count($location->objects)}}

                                                   @if(count($location->objects) == 1)
                                                   object
                                                   @else
                                                   objecten
                                                   @endif
                                                </div>
                                                <div>
                                                   @if($location->building_type_id)
                                                   <span
                                                      class=" badge bg-soft-primary text-primary py-1">{{config('globalValues.building_types')[$location->building_type_id]}}</span>
                                                   @else
                                                   <span class=" badge bg-soft-danger text-danger py-1 ">Onbekend</span>

                                                   @endif
                                                </div>
                                       </div>

                                       <span> {{$location->address}},
                                          {{$location->zipcode}} {{$location->place}}
                                       </span>
                                       <div class="pt-2 row justify-content-between align-items-center">

                                          <div class="col-auto  ">
                                             <!-- Form Check -->
                                             <div class="clearfix"></div>
                                             <a href="/customer/{{$location?->customer?->slug}}">
                                                {{$location?->customer?->name}}</a>

                                             <!-- End Form Check -->
                                          </div>
                                       </div>
                                    </div>
                                    <!-- End Body -->

                                 </div>
                                 <!-- End Card -->
                              </div>
                              <!-- End Col -->

                              @endforeach

                        </div>

                        @else
                        <div class="flex justify-center items-center space-x-2">

                           <center>
                              <div>
                                 <img src='/assets/img/illu/1-1-740x592.png' style="max-width: 500px; width: 100%;">

                                 <h4>Geen locaties gevonden......</h4>
                                 @if($this->cntFilters)
                                 Geen gegevens gevonden met de huidige filters...
                                 <hr>

                                 @else
                                 Geen locaties gevonden in het systeem. Voeg een nieuwe locatie toe
                                 overzicht
                                 @endif

                            <div class = "clear-fix"></div>
                            <a href = "/location/add">
                                 <button type="button" class="btn   btn-primary btn-sm mt-5"   >
            <i class="bi bi-plus"></i> Toevoegen
            </button></a>
                              </div>
                           </center>

                        </div>
                        @endif
                     </div>
                  </div>
               </div>
               </div>  </div>
          
         <div   wire:loading.remove class="card-footer">
            @if($items->links())
 
 {{ $items->links() }}
   @endif
</div>
 
       

 

      </div>