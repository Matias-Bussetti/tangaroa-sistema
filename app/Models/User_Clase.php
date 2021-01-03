<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Clase extends Model
{
    //me to many
    public function clase()
    {
      return $this->belongsTo('App\Models\Clase', 'clase_id');
    }

    //me to many
    public function user()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    //me to many
    public function pack()
    {
      return $this->belongsTo('App\Models\Pack', 'pack_id');
    }
}
