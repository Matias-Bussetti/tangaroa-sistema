<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semanas extends Model
{
    protected $fillable = ['name','color','pack_id'];

    //Relaciones

    //me to One

    public function pack()
    {
      return $this->belongsTo('App\Models\Pack', 'pack_id');
    }

    //me to many

    public function clases()
    {
      return $this->hasMany('App\Models\Clase');
    }

}
