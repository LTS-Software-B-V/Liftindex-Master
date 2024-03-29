<div class="container-fluid">
    <div class="page-header  my-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">
                    {{$object?->name}}
                </h1>
         
            </div>
            <div class="col-auto">
                <a href="/customers">
                    <button type="button" class="btn   btn-link btn-sm  ">
                        Alle relaties
                    </button></a>
 

 
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle btn-120  "
                    id="navbarNotificationsDropdownSettings" data-bs-toggle="dropdown" aria-expanded="false">
                    Toevoegen
                </button>
                <div class="dropdown-menu  navbar-dropdown-menu navbar-dropdown-menu-borderless"
                    aria-labelledby="navbarNotificationsDropdownSettings">
                    <a class="dropdown-item" href="/customer/contact/{{$object->id}}/create">
                        <i class="bi bi-person-lines-fill dropdown-item-icon"></i>Contactpersoon
                    </a>
                    <a class="dropdown-item" href="/customer/location/{{$object->id}}/create">
                        <i class="bi bi-map-fill  dropdown-item-icon"></i>Locatie
                    </a> 
                    <a class="dropdown-item" href="/customer/location/{{$object->id}}/create">
                        <i class="bi bi-paperclip dropdown-item-icon"></i>Bestand
                    </a>  
                    <a class="dropdown-item" href="/customer/project/{{$object->id}}/create">
                        <i class="bi bi-boxes dropdown-item-icon"></i>Project
                    </a>  

                   


                
                </div>
                <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm  btn-ico ">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row  ">
        <div class="col-md-6 col-sm-6">
        <div class="card-header   ">

Relatie gegevens
</div>

            <div class="card" style="height: 220px;">
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td class="align-middle" colspan="2">
                                {{$object->address}}
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle" colspan="2">
                                {{$object->zipcode}} {{$object->place}}
                            </td>
                        </tr>
                        <tr>
                            <td style= "width: 200px;" = class="align-middle"> E-mailadres </td>
                            <td>
                                @if($object->emailaddress)
                                <a href="mailto:{{$object->emailaddress}}">{{$object->emailaddress}}</a>
                                @else -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle"> Telefoonnummer </td>
                            <td>
                                @if($object->phonenumber)
                                <a href="tel:{{$object->emailaddress}}">{{$object->phonenumber}}</a>
                                @else -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle"> Website </td>
                            <td>
                                @if($object->phonenumber)
                                <a href="tel:{{$object->emailaddress}}">{{$object->website}}</a>
                                @else -
                                @endif
                            </td>
                        </tr>
                        </td>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
        <div class="card-header   ">

Statusstieken
</div>

            <div class="card" style="height: 220px;">
                <div class="card-body" >
                {{$object->remark}}
                </div>
            </div>
        </div>
    </div>
 
 
<div class="row pt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body pt-1">

<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="disabled-tab-0" data-bs-toggle="tab" href="#customer_tab-0" role="tab" aria-controls="customer_tab-0" aria-selected="true">Contactpersonen</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="disabled-tab-1" data-bs-toggle="tab" href="#customer_tab-1" role="tab" aria-controls="customer_tab-1" aria-selected="false">Locaties</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="disabled-tab-2" data-bs-toggle="tab" href="#customer_tab-2" role="tab" aria-controls="customer_tab-2" aria-selected="false">Objecten</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="disabled-tab-2" data-bs-toggle="tab" href="#customer_tab-3" role="tab" aria-controls="customer_tab-3" aria-selected="false">Bestanden</a>

  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="disabled-tab-2" data-bs-toggle="tab" href="#customer_tab-4" role="tab" aria-controls="customer_tab-4" aria-selected="false">Facturen</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="disabled-tab-2" data-bs-toggle="tab" href="#customer_tab-5" role="tab" aria-controls="customer_tab-5" aria-selected="false">Werkbonnen</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="disabled-tab-2" data-bs-toggle="tab" href="#customer_tab-6" role="tab" aria-controls="customer_tab-6" aria-selected="false">Projecten</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="disabled-tab-2" data-bs-toggle="tab" href="#customer_tab-7" role="tab" aria-controls="customer_tab-7" aria-selected="false">Storingen</a>
  </li>
</ul>
<div class="tab-content pt-5" id="tab-content">
  <div class="tab-pane active" id="customer_tab-0" role="tabpanel" aria-labelledby="disabled-tab-0"> @livewire('company.customers.contacts', ['debtor_id' => $object->id])</div>
  <div class="tab-pane" id="customer_tab-1" role="tabpanel" aria-labelledby="disabled-tab-1"> @livewire('company.customers.locations', ['debtor_id' => $object->id])</div>
  <div class="tab-pane" id="customer_tab-2" role="tabpanel" aria-labelledby="disabled-tab-2">@livewire('company.customers.objects', ['debtor_id' => $object->id])</div>
  <div class="tab-pane" id="customer_tab-3" role="tabpanel" aria-labelledby="disabled-tab-3">@livewire('company.customers.files', ['debtor_id' => $object->id])</div>
  <div class="tab-pane" id="customer_tab-4" role="tabpanel" aria-labelledby="disabled-tab-4">@livewire('company.customers.invoices', ['debtor_id' => $object->id])</div>
  <div class="tab-pane" id="customer_tab-5" role="tabpanel" aria-labelledby="disabled-tab-5">@livewire('company.customers.workorders', ['debtor_id' => $object->id])</div>
  <div class="tab-pane" id="customer_tab-6" role="tabpanel" aria-labelledby="disabled-tab-6">@livewire('company.customers.projects', ['debtor_id' => $object->id])</div>
  <div class="tab-pane" id="customer_tab-7" role="tabpanel" aria-labelledby="disabled-tab-7">@livewire('company.customers.incidents', ['debtor_id' => $object->id])</div>
</div>

 
                    <div wire:ignore.self class="modal fade" id="uploadModal" tabindex="-1" role="dialog"
                        aria-labelledby="crudModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadModalTitle">Bestand toevoegen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3"><img src="/assets/img/documents.svg"></div>
                                        <div class="col-md-9">
                                            <form action="/debtor.uploadfile" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <label for="fname">Bestandsnaam</label>
                                                <div class="pt-2"></div>
                                                <input class="form-control" id="description" name="description">
                                                <div class="pt-2"></div>
                                                <label for="fname">Categorie</label>
                                                <div class="pt-2"></div>
                                                <select class="form-select  " id="collection" name="collection" />
                                                <option selected value="documenten">Documenten</option>
                                                <option value="afbeeldingen ">Afbeeldingen</option>
                                                <option value="algemeen ">Algemeen</option>
                                                </select>
                                                <div class="pt-3"></div>
                                                <label>Bestand</label>
                                                <div class="pt-2"></div>
                                                <input type="hidden" id="debtor_id" name="debtor_id"
                                                    value="{{$object->id}}">
                                                <input type="file" class="form-control  " style="padding-top: 3px;"
                                                    id="attachment" name="attachment" />
                                                <div class="pt-2"></div>
                                                <div style="float: right;  ">
                                                    <button type="submit" class="btn btn-soft-success ">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>




            

                
   <!-- CrudModal  -->
   <div wire:ignore.self class="modal fade" id="crudModalContact" tabindex="-1" role="dialog" aria-labelledby="crudModalContact" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">Contactpersoon gegevens
  
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:loading.class="loading-div" >
                

 



<div class="row gy-3   ">



 

<div class=" col-md-12">
        <div class="card" ">
            <table class="table table-striped" style=" width 100%">
                <tr>
                <td class="align-middle">Naam</td> 
                   <td class="text-end"> <input class="form-control @error('contact_name') is-invalid @enderror" placeholder="" wire:model = "contact_name">
         @error('contact_name')
         <div class="invalid-feedback">{{ $message }}</div>
         @enderror</td>
                </tr>
                <tr>
                <td class="align-middle">Relatie</td> 

<td>
    
 
</td>
                <tr>  <tr class="align-middle">
                    <td>E-mailadres</td> 
                   <td class="text-end">     <input class="form-control @error('contact_emailaddress') is-invalid @enderror" wire:model = "contact_emailaddress">
         @error('contact_emailaddress')
         <div class="invalid-feedback">{{ $message }}</div>
         @enderror</td>
                </tr>
                <tr>
                    <td class="align-middle">Telefoonnummer</td>
                    <td class="text-end">   <input class="form-control @error('contact_phonenumber') is-invalid @enderror" wire:model = "contact_phonenumber">
         @error('contact_phonenumber')
         <div class="invalid-feedback">{{ $message }}</div>
         @enderror</td>
                </tr>
            </table>
        </div>
    </div>

 


 
 


 
            </div>
            <div class="modal-footer">

            @if($edit_id)
            <button   wire:click="delete({{$edit_id}})"     wire:confirm.prompt="Weet je zeker dat je deze beheerder wilt verwijderen?\n\nType AKKOORD voor bevestiging |AKKOORD"    type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-trash"></i>  
               </button> 
               @endif



               <button type="button" class="btn btn-white btn-120" data-bs-dismiss="modal">Sluiten</button>
               <button class="btn btn-soft-success btn-120    " wire:click="saveContact()" type="button">
                  <div wire:loading wire:target="save">
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Opslaan
               </button>
            </div>
         </div>
      </div>
   </div>
   <!-- CrudModal  -->
   <div wire:ignore.self class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">Relatie gegevens
  
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:loading.class="loading-div" >
               <div class = "row">
                  <div class = "col-md-12">
                     <div>
                        <label class = "pb-2">Naam</label>
                        <input wire:model = "name"  class  = "form-control    @error('name') is-invalid   @enderror  " >
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>
               <div class = "row">
                  <div class = "col-md-6">
                     <div class  = "pt-3">
                        <label class = "pb-2">Postcode</label>
                        <div class="input-group  ">
                           <input class="form-control required  @if ($errors->has('zipcode'))  is-invalid @endif " wire:model.defer="zipcode">
                           <div class="input-group-append">
                              <button class = "btn btn-soft-primary" style = "height: 43px" wire:click = "checkZipcode"  data-toggle="tooltip" data-placement="top" title="Zoek naar postcode" wire:keydown="checkZipcode" style = "height: 40px;">
                              <i class="bi-search"></i>
                              </button>
                           </div>
                           @if ($errors->has('zipcode')) <span class="text-danger">Postcode formaat niet juist</span> @endif
                        </div>
                     </div>
                     <div class  = "pt-3">
                        <label class = "pb-2">Plaats</label>
                        <input wire:model = "place"  class  = "form-control">
                     </div>
                  </div>
                  <div class = "col-md-6">
                     <div class  = "pt-3">
                        <label class = "pb-2">Adres</label>
                        <input wire:model = "address"  class  = "form-control">
                     </div>
                  </div>
               </div>
               <hr>
               <div class = "row">
                  <div class = "col-md-6">
                     <div >
                        <label class = "pb-2">Emailadres</label>
                        <input wire:model = "emailaddress"  class  = "form-control">
                     </div>
                  </div>
                  <div class = "col-md-6">
                     <div >
                        <label class = "pb-2">Telefoonnummer</label>
                        <input wire:model = "phonenumber"  class  = "form-control">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">

            @if($edit_id)
            <button   wire:click="delete({{$edit_id}})"     wire:confirm.prompt="Weet je zeker dat je deze beheerder wilt verwijderen?\n\nType AKKOORD voor bevestiging |AKKOORD"    type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-trash"></i>  
               </button> 
               @endif



               <button type="button" class="btn btn-white btn-120" data-bs-dismiss="modal">Sluiten</button>
               <button class="btn btn-soft-success btn-120    " wire:click="save()" type="button">
                  <div wire:loading wire:target="save">
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Opslaan
               </button>
            </div>
         </div>
      </div>
   </div>
            <!-- End Modal -->
    












        </div><script>
   document.addEventListener('livewire:init', () => {
      Livewire.on('close-crud-modal', (event) => {
         $('#crudModal').modal('hide');
      });
   });

   document.addEventListener('livewire:init', () => {
      Livewire.on('close-contact-crud-modal', (event) => {
         $('#crudModalContact').modal('hide');
      });
   });
</script>