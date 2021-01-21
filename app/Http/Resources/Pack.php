<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pack extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'subname' => $this->subname,
            'description' => $this->description,
            'price' => $this->price,
            'image_cuadrado'  => $this->image_cuadrado,
            'image_vertical'  => $this->image_vertical,
            'image_horizontal'  => $this->image_horizontal,
            'price_offer' => $this->price_offer,
            'date_offer' => $this->date_offer,
        ];
    }
    
}
