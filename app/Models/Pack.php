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

    public function presenciales()
    {
        return $this->hasMany('App\Models\Presencial');
    }

    public function userClases()
    {
        return $this->hasMany('App\Models\User_Clase');
    }

    public function userPacks()
    {
        return $this->hasMany('App\Models\User_Pack');
    }
}
