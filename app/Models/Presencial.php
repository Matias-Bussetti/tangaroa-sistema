<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presencial extends Model
{
        //me to one
        public function pack()
        {
          return $this->belongsTo('App\Models\Pack', 'pack_id');
        }
}
