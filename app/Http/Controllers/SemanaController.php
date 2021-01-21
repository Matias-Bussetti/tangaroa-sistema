<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Semana as SemanaResource;
use App\Models\Pack;
use App\Models\Semana;
use App\Models\User_Clase;

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
      $semana->color = "#ffed4a";

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
      return SemanaResource::collection(Semana::where('pack_id', $id)->orderby('id', 'ASC')->get());
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


    public function semanasClases($pack_id, $user_id){

      $pack = Pack::findorFail($pack_id);

      $array = new Collection;
      $array_semanas = new Collection;

      $clase_done = User_Clase::select('clase_id')->where('user_id',$user_id)->where('pack_id',$pack->id)->get()->map(
        function ($item, $key) {
          return $item->clase_id;
        });
    
        
      $clase_done = $clase_done->toArray();
        
      $counter = 0;

      foreach ($pack->semanas as $semana) {
        $counter += count( $semana->clases );
      }

      $array->push(["progreso" => round(count($clase_done) / $counter * 100 )]);
      

      foreach ($pack->semanas as $semana) {

        $clases = $semana->clases;
        
        $array_semanas->push([
          "semana" => [
            "id" => $semana->id,
            "name" => $semana->name,
            "color" => $semana->color,
            "clases" => $clases->map(function ($item, $key) use ($clase_done){
                return [
                  'id' => $item->id, 
                  'name' => $item->name, 
                  'done' => in_array(strval($item->id),$clase_done) ? "true" : "false", 
                ];
              })
          ]
        ]);

      }

    $array->push(["semanas" => $array_semanas]);

    return ["data" => $array];

    }
  }

