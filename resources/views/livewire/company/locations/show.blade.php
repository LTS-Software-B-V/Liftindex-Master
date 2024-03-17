<div class="container-fluid">
    <div class="page-header  my-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">
                @if($location->name)
                            {{$location->name}} @else Geen naam @endif
            </div>
            <div class="col-auto">

            <nav class="navbar-nav-wrap-col collapse navbar-collapse" id="navbarNavMenuHeight">
        <!-- Navbar -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="#">Active</a>
          </li>

          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarHeightDropdownSubMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>

            <div class="dropdown-menu" aria-labelledby="navbarHeightDropdownSubMenu" style="min-width: 230px;">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <!-- End Dropdown -->

          <!-- Nav Item -->
          <li class="nav-item">
            <a class="nav-link dropdown-toggle" href="#" id="navbarHeightMegaMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mega menu</a>

            <div class="dropdown-menu w-100" aria-labelledby="navbarHeightMegaMenu">
              <div class="row">
                <div class="col-lg-3 mb-3 mb-lg-0">
                  <span class="dropdown-header">One</span>

                  <a class="dropdown-item" href="#">One</a>
                  <a class="dropdown-item" href="#">Two</a>
                  <a class="dropdown-item" href="#">Three</a>
                </div>

                <div class="col-lg-3 mb-3 mb-lg-0">
                  <span class="dropdown-header">Two</span>

                  <a class="dropdown-item" href="#">One</a>
                  <a class="dropdown-item" href="#">Two</a>
                  <a class="dropdown-item" href="#">Three</a>
                </div>

                <div class="col-lg-3 mb-3 mb-lg-0">
                  <span class="dropdown-header">Three</span>

                  <a class="dropdown-item" href="#">One</a>
                  <a class="dropdown-item" href="#">Two</a>
                </div>

                <div class="col-lg-3">
                  <span class="dropdown-header">Four</span>

                  <a class="dropdown-item" href="#">One</a>
                  <a class="dropdown-item" href="#">Two</a>
                  <a class="dropdown-item" href="#">Three</a>
                </div>
              </div>
            </div>
          </li>
          <!-- End Nav Item -->

          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
        <!-- End Navbar -->
      </nav>
            <a href="/locations">
                    <button type="button" class="btn   btn-link btn-sm  ">
                        Alle locaties
                    </button></a>

                <a href = "/location/edit/{{$location->id}}">
                <button type="button" class="btn   btn-link btn-sm " wire:click="save()">
                    Wijzig
                </button>
                </a>

                <button type="button" onclick="history.back()" class="btn   btn-link btn-sm">
                 Terug
                </button>

            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">
        <div class="card">
        <div class="card-body">

      <center>



                    <span class="mb-2   " style = "width: 100%; ">

 @if($location->image)
 <a class="text-body" >

<img class="avatar-img   " style = "max-height: 220px;  width: 100%; " src="/storage/{{$location->image}}"  >
</a>
@else
<img class="avatar-img   "  style = "max-height: 220px; width: 100%;" src="/assets/img/160x160/img2.jpg"  >

@endif
</span>


         <div class = "clearfix mt-3 "></div>

 

         <span  > {{$location->address}}  {{$location->housenumber}},
                      {{$location->zipcode}} {{$location->place}}
                        </span>

                        <div class = "clearfix"></div>


@if($location->building_type)
                  <span
                     class="  mt-3  badge bg-soft-primary text-primary py-2 ">{{$location->building_type}}</span>
                  @else
                  <span class="     mt-3  badge bg-soft-danger text-danger  py-2 ">Onbekend</span>

                  @endif



</center>
</div></div>


<div class="row mt-3">

<div class="col-md-12">



<div class="card  bg-light">
<div class="card-body">

      <b>{{$location->customer?->name}}</b>
      <br>
      {{$location->customer?->address}} {{$location->customer?->place}}

</div>
</div>
</div>
</div>


 <div class = "card mt-3">
<table class= "table">
@if($location->remark)
<tr>
<td colspan="2">

{{$location->remark}}  </td>

</tr>
@endif

<tr>
    <td>Complexnummer</td>
    <td>@if($location->complexnumber) {{$location->complexnumber}} @else <span class=" badge bg-soft-primary text-primary ">Geen</span> @endif</td>
</tr>

<tr>
    <td>Relatie</td>
    <td>    <a href = "/customer/{{$location?->customer?->slug}}">   {{$location?->customer?->name}}</a>
                       </td>
</tr>



<tr>
    <td>Beheerder</td>
    <td>@if($location->managementcompany) {{$location->managementcompany->name}}  @else -  @endif</td>
</tr>



<tr>
    <td>Type toegang</td>
    <td> @if($location->building_access_type_id)  {{config('globalValues.building_access_types')[$location->building_access_type_id]}}  @endif</td>
</tr>

<tr>
    <td>Code</td>
    <td>  @if($location->access_code) {{$location->access_code}}  @endif</td>
</tr>

<tr>
    <td>Contactpersoon</td>
    <td>  @if($location->access_contact) {{$location->access_contact}}  @endif</td>
</tr>

<tr>
    <td>Locatie sleutelkleus</td>
    <td> @if($location->location_key_lock) {{$location->location_key_lock}}  @endif</td>
</tr>





</table>
</div>
</div>


        <div class="col-md-9">



        @if($location->gps_lon)

        <div class="card p-1 mb-3">

 <iframe class = "p-1" width="100%" height="219 " style = "border-radius: 10px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=200&amp;hl=en&amp;q={{$location->gps_lat}},{{$location->gps_lon}}+(My%20Business%20Name)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>


</div>

@endif

        <div class="card  p-1">



        <div class="card-body p-2">
                    <div class = "row">
                    <div class="col-md-3">
                            <label class="pb-2  ">GPS Longitude</label>
                            <div class = "clear-fix"></div>
                                @if($location->gps_lon) {{$location->gps_lon}} @else - @endif



                        </div>

                        <div class="col-md-3">
                            <label class="pb-2  ">GPS latitude</label>
                            <div class = "clear-fix"></div>
                                @if($location->gps_lat) {{$location->gps_lat}} @else - @endif



                        </div>

                        <div class="col-md-6">
                            <label class="pb-2  ">Gemeente</label>
                            <div class = "clear-fix"></div>
                                @if($location->municipality) {{$location->municipality}} @else - @endif


                        </div>


                    </div>       </div>
                </div>

                <div class="card mt-3 p-1">



                <div class="card-body p-2">
                    <div class = "row">
                    <div class="col-md-3">
                                <label class="pb-2">Bouwjaar</label>
                                <div class = "clear-fix"></div>
                                @if($location->construction_year) {{$location->construction_year}} @else - @endif

                                        </div>

                            <div class="col-md-3">
                                <label class="pb-2">Verdiepingen</label>
                                <div class = "clear-fix"></div>
                                @if($location->levels) {{$location->levels}} @else - @endif


                            </div>

                            <div class="col-md-3">
                                <label class="pb-2">Oppervlakte</label>
                                <div class = "clear-fix"></div>
                                @if($location->surface) {{$location->surface}} @else - @endif


                            </div>
                </div>

                </div>       </div>

                <div class="card  mt-3 ">
                  <div class="card-header ">

  Aanwezig objecten
  </div>

                <div class="card-body    p-2 ">
                    <div class = "row gx-2">
                        <div class = "col-md-12">
                           <div>

                           @if(count($location->objects))

                           <table class="table tabel-striped table-hover">
  <thead>
    <tr>

      <th scope="col">Adres</th>
      <th scope="col">Nobonummer</th>
      <th scope="col">Onderhoudspartij</th>

      <th scope="col">Type</th>

    </tr>
  </thead>
  <tbody>


                           @forelse ($location->objects  as $elevator)
                           <tr>
      <tr onclick="window.location='/elevator/show/{{ $elevator->id }}'"  wire:key="row-{{ $elevator->id }}">

      <td> @if ($elevator->address) @if ($elevator->address->name) <b>{{ $elevator->address->name }}</b>
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
                        </small> </td>
                          <td>{{ $elevator->nobo_no}}</td>

      <td>@if ($elevator->maintenancecompany) {{ $elevator->maintenancecompany->name }} @endif</td>

      <td>  @if($elevator?->object_type_id)
               <small>
               {{config('globalValues.object_types')[$elevator?->object_type_id]}}</small>
               @endif {{ $elevator->disapprovedState }} @if ($elevator->disapprovedState != null)								@if($management_elevator)

                        @endif</td>
                        <td>@if ($elevator->address) @if ($elevator->address->name) <b>{{ $elevator->address->name }}</b>
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

                        @endif
                     </div></td>

    </tr>
                           @endforeach


  </tbody>
</table>


@else
Geen objecten gevonden op deze locatie
@endif


                        </div>
                     </div>


            </div>
        </div>

    </div>
</div>