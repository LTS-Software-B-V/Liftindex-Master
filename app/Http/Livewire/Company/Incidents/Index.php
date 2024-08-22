<?php

namespace App\Http\Livewire\Company\Incidents;

use Livewire\Component;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

use App\Models\maintenanceCompany;
use App\Models\Incident;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Index extends Component
{
    use WithPerPagePagination;
    use WithSorting;
    use WithBulkActions;
    use WithCachedRows;


    public $page_number = 0;
    public $cntFilters;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    public $filters  =
    [
        'status_id'                    => '',
        'keyword'               => '',
        'maintenance_company_id'               => '',



    ];


    public function render()
    {
        return view(
            'livewire.company.incidents.index',
            [
                'items' => $this->rows,
                'maintenanceCompanys' => maintenanceCompany::orderBy('name', 'asc')->get() ,
   
            ]
        );




    }



    public function updatedFilters()
    {
        Session()->put('incident_search_filters', json_encode($this->filters));
    }


    public function updated()
    {
        $this->gotoPage(1);
    }

    public function mount()
    {
        if (session()
            ->get('incident_search_filters')) {
            $this->filters = json_decode(session()
                ->get('incident_search_filters'), true);
        }
    }



    public function resetFilters()
    {
        $this->reset('filters');
        session()->pull('incident_search_filters', '');
        $this->gotoPage(1);
    }

    public function getRowsQueryProperty()
    {

        $query = Incident::where("status_id", "!=", 99)->where("status_id", "!=", 6)->orderby('report_date_time', 'DESC')

         ->when($this->filters['status_id'], function ($query) {
             $query->where('status_id', $this->filters['status_id']);
         })



         ->when($this->filters['maintenance_company_id'], function ($query) {
            $query->whereHas('elevator.maintenancecompany', function ($query) {
                $query->whereIn('id', $this->filters['maintenance_company_id']);
           
            });
        })


       


          ->when($this->filters['keyword'], function ($query) {
              $query->whereHas('elevator.address', function ($query) {
                  $query->where('address', 'like', '%' . $this->filters['keyword'] . '%')
                  ->orwhere('place', 'like', '%' . $this->filters['keyword'] . '%')
                  ->orwhere('name', 'like', '%' . $this->filters['keyword'] . '%')
                  ->orwhere('unit_no', 'like', '%' . $this->filters['keyword'] . '%')
                  ->orwhere('nobo_no', 'like', '%' . $this->filters['keyword'] . '%')
                  ->orwhere('id', 'like', '%' . $this->filters['keyword'] . '%');
              });

              //     ->Where('id', 'like', '%' . (string)((int)($this->filters['filter_keyword'])) . '%')

              //  ->OrWhere('description', );


              //  ->OrWhere('description', );


              //
          });


        return $query;
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }



    public function delete($id){
        $item=Incident::find($id);
        $item->delete();  
        return redirect(request()->header('Referer'));
    }

 


}