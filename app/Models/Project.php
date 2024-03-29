<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Statuses;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use OwenIt\Auditing\Contracts\Auditable;
use Log;
use Str;
class Project extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public static function boot() {
  
      parent::boot();
  
      static::created(function($item) {           
        $status = Statuses::where('id', $item->status_id)->first();
        $item->progress =$status->procent;
      });
 
      static::updating(function($item) {             
        $status = Statuses::where('id', $item->status_id)->first();
        $item->progress =$status->procent;
      });
 
  }

    
 
    static $rules = [
      'name' => 'required',
      'customer_id' => 'required',
    ];
    
    // Number of items to be shown per page
    protected $perPage = 20;

    // Attributes that should be mass-assignable
    protected $fillable = ['slug','name','description','code','customer_id','progress','startdate','enddate','status_id','budget_hours','budget_costs','contact_person_name'];
   
    public function status()
    {
        return $this->belongsTo(Statuses::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }



}
