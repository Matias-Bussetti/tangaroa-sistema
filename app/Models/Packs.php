<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packs extends Model
{
    protected $fillable = ['name','description','position','price','price_offer','date_offer','image'];

    //Relaciones

    //me to many

    public function semanas()
    {
        return $this->hasMany('App\Models\Semanas');
    }
}
