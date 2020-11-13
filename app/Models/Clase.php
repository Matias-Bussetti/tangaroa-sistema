<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = ['name','description','link'];


    //Relaciones

    //me to One

    public function group()
    {
      return $this->morphTo();
    }
}
