<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Presencial extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name' => $this->name,
            'fecha'  => $this->fecha,
            'hora_inicio'  => $this->hora_inicio,
            'hora_fin'  => $this->hora_fin,
            'pack_id'  => $this->pack_id,
        ];
    }
}
