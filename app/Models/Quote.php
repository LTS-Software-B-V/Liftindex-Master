<?php

namespace App\Models;

use App\Models\Statuses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use Log;
use Str;
class Quote extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;





    // Attributes that should be mass-assignable
    protected $fillable = ['number','type'];


    public function status()
    {
        return $this->hasMany(Statuses::class,'id','status_id');
    }


}
