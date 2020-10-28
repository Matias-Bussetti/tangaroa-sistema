<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
    protected $fillable = ['name','description','link','type','type_id'];


    //Relaciones

    //me to One

    public function foreign()
    {
      return $this->belongsTo('App\Models\Semanas','foreign_id');
    }
}
