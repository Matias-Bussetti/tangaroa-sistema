<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Pack as PackResource;
use App\Models\Pack;

class PackController extends Controller
{

    public function list(){

      
      $packs = Auth::user()->userPacks->map(function ($item, $key){
        return $item->pack;
      });

      return view('home', compact('packs'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //Retorna todos los paquetes
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

      // * Mensajes del Validador
      $messages = [
      'name.required' => 'Ingrese un Nombre',
      'description.required' => 'Escriba un descripción',
      'price.required' => 'Ingrese un Precio',
      'price.numeric' => 'El Precio debe de ser numerico',
      'type.required' => 'Elige el tipo del paquete',
      'image_vertical.required' => 'Elija una Imagen',
      'image_vertical.file' => 'Elija una Imagen que sea un archivo',
      'image_vertical.max' => 'Elija una Imagen que menor de 20 mb',
      'image_vertical.mimes' => 'Elija una Imagen con la extención: jpeg o png',
      'image_horizontal.required' => 'Elija una Imagen',
      'image_horizontal.file' => 'Elija una Imagen que sea un archivo',
      'image_horizontal.max' => 'Elija una Imagen que menor de 20 mb',
      'image_horizontal.mimes' => 'Elija una Imagen con la extención: jpeg o png',
      ];

      // * Reglas del validador
      $validator = Validator::make($request->all(), [
      'name' => 'required',
      'description' => 'required',
      'price' => 'required|numeric',
      'type' => 'required',
      'image_vertical' => 'required|file|max:20000|mimes:jpeg,png',
      'image_horizontal' => 'required|file|max:20000|mimes:jpeg,png',
      ], $messages);

      // * Lo que suscede si el validador falla
      if ($validator->fails()) {

        $errors = $validator->errors();

        return ['data' => ['errors' => $errors]];
      }

      if (request()->hasFile('image_vertical'))//---> Valida que la imagen sea un archivo
      {
        $file = $request->file('image_vertical');//---> asignamos a $file el valor de lo que traemos del request como imagen
        $extension = $file->getClientOriginalExtension();//---> asigmanos a $extension la extencion del archivo
        $file_name_vertical = time()."-".$request->input('name')."-vertical.".$extension;//---> armamos el nombre del archivo
        Storage::disk('pack')->put($file_name_vertical, file_get_contents($file));//---> guardamos el archivo en el storage
      }

      if (request()->hasFile('image_horizontal'))//---> Valida que la imagen sea un archivo
      {
        $file = $request->file('image_horizontal');//---> asignamos a $file el valor de lo que traemos del request como imagen
        $extension = $file->getClientOriginalExtension();//---> asigmanos a $extension la extencion del archivo
        $file_name_horizontal = time()."-".$request->input('name')."-horizontal.".$extension;//---> armamos el nombre del archivo
        Storage::disk('pack')->put($file_name_horizontal, file_get_contents($file));//---> guardamos el archivo en el storage
      }
      
      // * Ya que paso el validador, se crea un paquete con los datos del request

      $pack = new Pack;

      $pack->name = $request->input('name');
      $pack->description = $request->input('description');
      $pack->position = $request->input('position');
      $pack->price = $request->input('price');
      $pack->type = $request->input('type');
      $pack->image_vertical = strval("/img/pack/".$file_name_vertical);
      $pack->image_horizontal = strval("/img/pack/".$file_name_horizontal);

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
      // * Busca el paquete con el id traido por parametro
      $pack = Pack::findorFail($id);

      return new PackResource($pack);

    }

    public function showView($name, $id)
    {
      
      $pack = Pack::findorFail($id);

      if (Auth::user()->isAdmin == 0) {

      $pack = Auth::user()->userPacks->map(function ($item, $key) use ($id, $name){
        if($item->pack->id == $id && $item->pack->name == $name) {
          return $item->pack;
        }
      })->whereNotNull()->first();

      }

      if(!($pack == [])){

        return view('Packs.show', compact('pack'));

      } else {

        abort(404);
      }
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Packs.edit', compact('id'));
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
      'description.required' => 'Escriba un descripción',
      'price.required' => 'Ingrese un Precio',
      'price.numeric' => 'El Precio debe de ser numerico',
      'price.gt' => 'El Precio debe de ser mayor de 0',
      'price_offer.numeric' => 'El Precio de oferta debe de ser numerico',
      'price_offer.lt' => 'El Precio de oferta debe de ser menor al Precio sin oferta',
      'price_offer.gt' => 'El Precio de oferta debe de ser mayor de 0',
      'date_offer.after' => 'La fecha de la oferta tiene que ser mayor a hoy',
      'image_vertical.file' => 'Elija una Imagen que sea un archivo',
      'image_vertical.max' => 'Elija una Imagen que menor de 20 mb',
      'image_vertical.mimes' => 'Elija una Imagen con la extención: jpeg o png',
      'image_horizontal.file' => 'Elija una Imagen que sea un archivo',
      'image_horizontal.max' => 'Elija una Imagen que menor de 20 mb',
      'image_horizontal.mimes' => 'Elija una Imagen con la extención: jpeg o png',
      ];

      // * Reglas del validador, sin las reglas de la imagen
      
      $validator = Validator::make($request->all(), [
      'name' => 'required',
      'description' => 'required',
      'price' => 'required|numeric|gt:0',
      'price_offer' => 'numeric|lt:price|gt:0',
      'date_offer' => 'after:today',
      'image_vertical' => 'file|max:20000|mimes:jpeg,png',
      'image_horizontal' => 'file|max:20000|mimes:jpeg,png',
      ], $messages);

      // * Lo que sucede si el validador falla

      if ($validator->fails()) {

        $errors = $validator->errors();

        return ['data' => ['errors' => $errors]];

      }

      // * Si el validador no falla, busca el paquete con el id que viene por parametro

      $pack = Pack::findOrFail($id);

      if (request()->hasFile('image_vertical'))//---> Valida que la imagen sea un archivo
      {
        $file = $request->file('image_vertical');//---> asignamos a $file el valor de lo que traemos del request como imagen
        $extension = $file->getClientOriginalExtension();//---> asigmanos a $extension la extencion del archivo
        $file_name_vertical = str_replace("/img/pack/","",$pack->image_vertical);
        Storage::disk('pack')->put($file_name_vertical, file_get_contents($file));//---> guardamos el archivo en el storage
      }

      if (request()->hasFile('image_horizontal'))//---> Valida que la imagen sea un archivo
      {
        $file = $request->file('image_horizontal');//---> asignamos a $file el valor de lo que traemos del request como imagen
        $extension = $file->getClientOriginalExtension();//---> asigmanos a $extension la extencion del archivo
        $file_name_horizontal = str_replace("/img/pack/","",$pack->image_horizontal);//---> armamos el nombre del archivo
        Storage::disk('pack')->put($file_name_horizontal, file_get_contents($file));//---> guardamos el archivo en el storage
      }

      $pack->name = $request->input('name');
      $pack->description = $request->input('description');
      $pack->position = $request->input('position');
      $pack->price = $request->input('price');
      $pack->price_offer = $request->input('price_offer');
      $pack->date_offer = $request->input('date_offer');
      
      //dd($pack);
      
      if($pack->save()) {
          return new PackResource($pack);
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
          return new PackResource($pack);
      }

    }
    
}
