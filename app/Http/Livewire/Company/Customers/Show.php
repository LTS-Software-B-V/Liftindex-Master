<?php

namespace App\Http\Livewire\Company\Customers;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Contact;
 

class Show extends Component
{
    public $name;
    public $phonenumber;
    public $address;
    public $zipcode;
    public $place;
    public $emailaddress;
    public $edit_id;
    public $customer;
    public $object;

    //Contacts
    public $contact_name;
    public $contact_emailaddress;
    public $contact_phonenumber;
    public $contact_edit_id;

    public function render()
    {
        return view('livewire.company.customers.show');
    }

    
    public function mount(Request $request)
    {
        $this->object = Customer::findBySlug($request->slug);
  

    }


    public function edit($id)
    {
        $this->edit_id = $id;

        $item = Customer::where('id', $id)->first();
        $this->address      = $item->address;
        $this->zipcode      = $item->zipcode;
        $this->place        = $item->place;
        $this->name         = $item->name;
        $this->place        = $item->place;
        $this->emailaddress = $item->emailaddress;
        $this->phonenumber  = $item->phonenumber;
        $this->function  = $item->function;
    }

    protected $rules = [
        'name' => 'required|min:6',
    ];


    public function saveContact(){

        $data = Contact::updateOrCreate(
            ['id' =>$this->contact_edit_id],
            [
                'name' => $this->contact_name,
                'place' => $this->contact_emailaddress,
                'phonenumber' => $this->contact_phonenumber,
                'customer_id' =>  $this->object->id,
               
                
            ]
        );
     
        $this->dispatch('close-contact-crud-modal');
    
     
            
        pnotify()->addWarning('Gegevens opgeslagen');
        return redirect(request()->header('Referer'));


    }


    public function save(){
   
        $this->validate();
            $data = Customer::updateOrCreate(
                ['id' =>$this->edit_id],
                [
                    'name' => $this->name,
                    'place' => $this->place,
                    'zipcode' => $this->zipcode,
                    'name' => $this->name,
                    'address' => $this->address,
                    'emailaddress' => $this->emailaddress,
                    'phonenumber' => $this->phonenumber,
                    
                ]
            );
         
            $this->dispatch('close-crud-modal');
            $this->clear();
         
                
            pnotify()->addWarning('Gegevens opgeslagen');
        
        }


        public function clear()
{
    $this->name =NULL;
    $this->address =NULL;
    $this->zipcode =NULL;
    $this->place =NULL;;
    $this->emailaddress =NULL;
    $this->phonenumber =NULL;
    $this->edit_id;
 
}


    public function delete($id){
        $item=Customer::find($id);
        $this->clear();
        $item->delete();  
        $this->dispatch('close-crud-modal');
        pnotify()->addWarning('Gegevens verwijderd');
    }


}
