<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\assetBrand;
use App\Models\assetCategorie;


class assetModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name','brand_id','category_id','image'
    ];

    public function brand(){
        return $this->belongsTo(assetBrand::class);
    }

    public function category(){
        return $this->belongsTo(assetCategorie::class);
    }

 


 
}


