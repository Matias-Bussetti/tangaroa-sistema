<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Clase as ClaseResource;
use App\Http\Resources\Pack as PackResource;
use App\Models\Pack;
use App\Models\Semana;
use App\Models\Clase;
use App\User;
use App\Models\User_Clase;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($semana_id)
    {
        return ClaseResource::collection(Semana::findorFail($semana_id)->clases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $clase = new Clase;

        $semana = Semana::findorFail($request->input('semana_id'));
        $pack = Pack::findorFail($semana->pack_id);

        $clase->name = "Día ".((count($pack->semanas)-1)*5+(count($semana->clases)+1));

        $clase->group_id = $semana->id;
        $clase->group_type = "App\Models\Semana";

        if($clase->save()) {
            return new ClaseResource($clase);
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
        return ClaseResource::collection(Clase::findorFail($id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showView($name, $id)
    {
        $clase = Clase::select('id','name','description','link')->where('id',$id)->where('name',$name)->first();
        return view('Clases.show', compact('clase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $clase_name
     * @param  int  $clase_id
     * @return \Illuminate\Http\Response
     */
    public function edit($clase_name, $clase_id)
    {
        $clase = Clase::where('id',$clase_id)->where('name',$clase_name)->first();

        return view('Clases.edit',compact('clase'));
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
        //

        // * Mensajes del Validador
      $messages = [
        'name.required' => 'Ingrese un Nombre',
        'name.max' => 'Ingrese un Nombre con menos de 30 caracteres',
        'description.required' => 'Escriba un descripción',
        'link.required' => 'Ingrese un link',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'description' => 'required',
            'link' => 'required',
        ], $messages);

        if ($validator->fails()) {

            $errors = $validator->errors();
    
            return ['data' => ['errors' => $errors]];
    
          }

          $clase = Clase::findOrFail($id);

          $clase->name = $request->input('name');
          $clase->description = $request->input('description');
          $clase->link = $request->input('link');
    
          if($clase->save()) {
              return new PackResource($clase->group->pack);
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


    public function claseDone($clase_id, $user_id){

        $user = User::findOrFail($user_id);

        $clase = Clase::findOrFail($clase_id);

        if(User_Clase::where('clase_id',$clase_id)->where('user_id',$user_id)->get()->isEmpty()){

            $user_clase = new User_Clase();
            $user_clase->clase_id = $clase_id;
            $user_clase->user_id = $user_id;
            $user_clase->pack_id = $clase->group->pack->id;

            $user_clase->save();
       
        }

        return new PackResource($clase->group->pack);

    }
}
