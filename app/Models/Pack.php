<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $fillable = [
        'name',
        'description',
        'position',
        'price',
        'price_offer',
        'date_offer',
        'image'
    ];

    //Relaciones

    //me to many

    public function semanas()
    {
        return $this->hasMany('App\Models\Semana');
    }
}
