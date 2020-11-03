<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Pack as PackResource;
use App\Models\Pack;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      Log::info('USER LOGIN.');
      return PackResource::collection(Pack::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Packs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //return $request->all();

      $messages = [
      'name.required' => 'Ingrese un Nombre',
      'description.required' => 'Escriba un descripción',
      'price.required' => 'Ingrese un Precio',
      'price.numeric' => 'El Precio debe de ser numerico',
      'image.required' => 'Elija una Imagen',
      'image.file' => 'Elija una Imagen que sea un archivo',
      'image.max' => 'Elija una Imagen que menor de 20 mb',
      'image.mimes' => 'Elija una Imagen con la extención: jpeg o png',
      ];
      $validator = Validator::make($request->all(), [
      'name' => 'required',
      'description' => 'required',
      'price' => 'required|numeric',
      'image' => 'required|file|max:20000|mimes:jpeg,png',
      ], $messages);

      if ($validator->fails()) {

        $errors = $validator->errors();

        return ['data' => ['errors' => $errors]];
      }

      if (request()->hasFile('image'))//---> Valida que la imagen sea un archivo
      {
        $file = $request->file('image');//---> asignamos a $file el valor de lo que traemos del request como imagen
        $extension = $file->getClientOriginalExtension();//---> asigmanos a $extension la extencion del archivo
        $file_name = time()."-".$request->input('name').".".$extension;//---> armamos el nombre del archivo
        Storage::disk('pack')->put($file_name, file_get_contents($file));//---> guardamos el archivo en el storage
      }
      
      

      $pack = new Pack;

      $pack->name = $request->input('name');
      $pack->description = $request->input('description');
      $pack->position = $request->input('position');
      $pack->price = $request->input('price');
      $pack->image = strval("/img/pack/".$file_name);

      if($pack->save()) {
          return new PackResource($pack);
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
      $article = Pack::findorFail($id);

      return new PackResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $pack = Pack::findorFail($id);

      $pack->name = $request->input('name');
      $pack->description = $request->input('description');
      $pack->position = $request->input('position');
      $pack->price = $request->input('price');
      $pack->image = $request->input('image');

      if($pack->save()) {
          return new PackResource($article);
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
      $pack = Pack::findorFail($id);

      if($pack->delete()) {
          return new PackResource($article);
      }
    }
}
