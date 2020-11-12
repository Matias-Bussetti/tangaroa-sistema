<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Semana as SemanaResource;
use App\Models\Pack;
use App\Models\Semana;

class SemanaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $semana = new Semana;

      $pack = Pack::findorFail($request->input('pack_id'));

      $semana->name = "Semana ".($pack->semanas->count() + 1);
      $semana->pack_id = $pack->id;

      if($semana->save()) {
          return new SemanaResource($semana);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return SemanaResource::collection(Semana::where('pack_id', $id)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // * mensajes del validador 
      $messages = [
      'name.required' => 'Ingrese un Nombre',
      'color.required' => 'Elija un color',
      ];

      // * Reglas del validador, sin las reglas de la imagen
      
      $validator = Validator::make($request->all(), [
      'name' => 'required',
      'color' => 'required',
      ], $messages);

      // * Lo que sucede si el validador falla

      if ($validator->fails()) {

        $errors = $validator->errors();

        return ['data' => ['errors' => $errors]];

      }

      // * Si el validador no falla, busca el paquete con el id que viene por parametro

      $semana = Semana::findOrFail($id);

      $semana->name = $request->input('name');
      $semana->color = $request->input('color');

      if($semana->save()) {
          return new SemanaResource($semana);
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $semana = Semana::findorFail($id);

      if($semana->delete()) {
          return new SemanaResource($semana);
      }

    }
}

