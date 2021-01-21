<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Presencial as PresencialResource;
use App\Http\Resources\Pack as PackResource;
use App\Models\Presencial;

class PresencialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create($id)
    {
      return view('Presenciales.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // * Mensajes del Validador
        $messages = [
            'name.required' => 'Ingrese un Nombre',
            'name.max' => 'Ingrese un Nombre con menos de 20 caracteres',
            'hora_inicio.required' => 'Ingrese la hora en la que empieza la clase',
            'hora_fin.required' => 'Ingrese la hora en la que termina la clase',
            'fecha.required' => 'Elija un día en el cual se dicte la clase',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'fecha' => 'required',
        ], $messages);

        if ($validator->fails()) {

            $errors = $validator->errors();

            return ['data' => ['errors' => $errors]];

        }

        if(Carbon::parse($request->input('hora_fin'))->format("H:i:s") < Carbon::parse($request->input('hora_inicio'))->format("H:i:s") ) {
            return ['data' => ['errors' => ['hora_inicio' => ["La hora en la que empieza la clase debe de ser menor que a la hora que termina"], 'hora_fin' => ["La hora en la que termina la clase debe de ser mayor que a la hora que empieza"] ] ] ];
        }

        if( Carbon::parse($request->input('hora_fin'))->diffInMinutes(Carbon::parse($request->input('hora_inicio'))) < 30 ) {
            return ['data' => ['errors' => ['hora_fin' => ["La hora en la que termina la clase debe de tener una diferencia de 30 minutos a la hora que empieza"] ] ] ];
        }

        $presencial = new Presencial;
        
        $presencial->name = $request->input('name');
        $presencial->hora_inicio = $request->input('hora_inicio');
        $presencial->hora_fin = $request->input('hora_fin');
        $presencial->fecha = Carbon::now()->subday(1)->next($request->input('fecha'))->format('Y-m-d');
        $presencial->pack_id = $request->input('pack_id');

        if($presencial->save()) {
            return new PackResource($presencial->pack);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPack($id)
    {
        $presenciales = Presencial::where('pack_id', $id)->get()->map(function ($item, $key) {
            $item->fecha < Carbon::now()->subday(1) ?  $item->link = NULL : $item->link;
            $item->fecha < Carbon::now()->subday(1) ?  $item->fecha = Carbon::parse($item->fecha)->addday(7)->format('Y-m-d') : $item->fecha;
            $item->save();
            return $item;
        });
        //dd($presenciales);
        return PresencialResource::collection($presenciales->sortBy('fecha'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presencial = Presencial::findorFail($id);

        return new PresencialResource($presencial);
    }

    public function edit($id)
    {
        return view('Presenciales.edit', compact('id'));
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
        // * Mensajes del Validador
        $messages = [
            'name.required' => 'Ingrese un Nombre',
            'name.max' => 'Ingrese un Nombre con menos de 20 caracteres',
            'hora_inicio.required' => 'Ingrese la hora en la que empieza la clase',
            'hora_fin.required' => 'Ingrese la hora en la que termina la clase',
            'fecha.required' => 'Elija un día en el cual se dicte la clase',
        ];
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'fecha' => 'required',
        ], $messages);
        
        if ($validator->fails()) {
            
            $errors = $validator->errors();
            
            return ['data' => ['errors' => $errors]];

        }
        
        if(Carbon::parse($request->input('hora_fin'))->format("H:i:s") < Carbon::parse($request->input('hora_inicio'))->format("H:i:s") ) {
            return ['data' => ['errors' => ['hora_inicio' => ["La hora en la que empieza la clase debe de ser menor que a la hora que termina"], 'hora_fin' => ["La hora en la que termina la clase debe de ser mayor que a la hora que empieza"] ] ] ];
        }
        
        if( Carbon::parse($request->input('hora_fin'))->diffInMinutes(Carbon::parse($request->input('hora_inicio'))) < 30 ) {
            return ['data' => ['errors' => ['hora_fin' => ["La hora en la que termina la clase debe de tener una diferencia de 30 minutos a la hora que empieza"] ] ] ];
        }
        
        $presencial = Presencial::findorFail($id);
        
        $presencial->name = $request->input('name');
        $presencial->hora_inicio = $request->input('hora_inicio');
        $presencial->hora_fin = $request->input('hora_fin');
        $presencial->fecha = Carbon::now()->subday(1)->next($request->input('fecha'))->format('Y-m-d');
        $presencial->link = $request->input('link');

        //return new PresencialResource($presencial);

        if($presencial->save()) {
            return new PackResource($presencial->pack);
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
        //
    }

    public function giveLink($id)
    {
        $presencial = Presencial::findOrFail($id);

        $start = Carbon::createFromFormat('Y-m-d H:i:s',$presencial->fecha . " " . $presencial->hora_inicio);
        $finish = Carbon::createFromFormat('Y-m-d H:i:s',$presencial->fecha . " " . $presencial->hora_fin);

        /*if (Carbon::now()->between($start, $finish)) {*/
            return ["data" => $presencial->link];
        /*} else {
            abort(404);
        }*/
    }
}
