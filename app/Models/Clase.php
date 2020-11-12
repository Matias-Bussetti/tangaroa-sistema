<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = ['name','description','link','type','foreign_id'];


    //Relaciones

    //me to One

    public function group()
    {
      return $this->morphTo();
    }
}
