<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    protected $fillable = ['name','description','image_profile'];

    //Relationships
    //me to one
    public function user()
    {
      return $this->belongsTo('App\User', 'user_id');
    }
}
