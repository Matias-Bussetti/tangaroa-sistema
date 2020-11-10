<?php

namespace App\Observers;

use App\Models\Pack;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PackObserver
{
    /**
     * Handle the pack "created" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function created(Pack $pack)
    {
        //
        Log::channel('pack')->info('Se creo un paquete a las ' . date('d/m/y H:i') . ' con el nombre "' . $pack->name . '" y con un precio de $' . $pack->price );
        
    }

    /**
     * Handle the pack "updated" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function updated(Pack $pack)
    {
        //
        Log::channel('pack')->info('Se actualizo un paquete a las ' . date('d/m/y H:i') . ' con el nombre "' . $pack->name . '" y con un precio de $' . $pack->price );

    }

    /**
     * Handle the pack "deleted" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function deleted(Pack $pack)
    {
        //
        Log::channel('pack')->info('Se borro un paquete a las ' . date('d/m/y H:i') . ' con el nombre "' . $pack->name . '" y con un precio de $' . $pack->price );

    }

    /**
     * Handle the pack "restored" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function restored(Pack $pack)
    {
        //
        Log::channel('pack')->info('Se restauro un paquete a las ' . date('d/m/y H:i') . ' con el nombre "' . $pack->name . '" y con un precio de $' . $pack->price );

    }

    /**
     * Handle the pack "force deleted" event.
     *
     * @param  \App\Pack  $pack
     * @return void
     */
    public function forceDeleted(Pack $pack)
    {
        //
        Log::channel('pack')->info('Se borro permanentemente un paquete a las ' . date('d/m/y H:i') . ' con el nombre "' . $pack->name . '" y con un precio de $' . $pack->price );

    }
}
