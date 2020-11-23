<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Pack extends Model
{
    //me to many
    public function pack()
    {
      return $this->belongsTo('App\Models\Pack', 'pack_id');
    }

    //me to many
    public function user()
    {
      return $this->belongsTo('App\User', 'user_id');
    }
}
