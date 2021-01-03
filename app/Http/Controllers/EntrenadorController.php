<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use App\Models\Entrenador;
use App\Http\Resources\Entrenador as EntrenadorResource;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Validator;

class EntrenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $entrenadores = User::where('isAdmin',1)->with('entrenador')->get();
        $entrenadores = $entrenadores->whereNotNull('entrenador');

        return view('Entrenadores.show', compact('entrenadores'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Entrenadores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         // * Mensajes del Validador
        $messages = [
            'name.required' => 'Ingrese un Nombre',
            'email.required' => 'Escriba un correo Electrónico',
            'email.required' => 'Escriba un correo Electrónico con el formato correcto',
            'password.required' => 'Escriba una contraseña',
            'description.required' => 'Escriba una descripción',
            'image_profile.required' => 'Elija una Imagen',
            'image_profile.file' => 'Elija una Imagen que sea un archivo',
            'image_profile.max' => 'Elija una Imagen que menor de 20 mb',
            'image_profile.mimes' => 'Elija una Imagen con la extención: jpeg o png',
        ];
  
        // * Reglas del validador
        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email:rfc,dns',
        'password' => 'required',
        'description' => 'required',
        'image_profile' => 'required|file|max:20000|mimes:jpeg,png',
        ], $messages);
  
        // * Lo que suscede si el validador falla
        if ($validator->fails()) {
  
          $errors = $validator->errors();
  
          return ['data' => ['errors' => $errors]];

        }
  
  
        
        
        // * Ya que paso el validador, se crea un paquete con los datos del request
  
        $user = new User();
  
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->isAdmin = 1;

        //dd($user);

        if($user->save()) {

            $entrenador = new Entrenador();

            $entrenador->user_id = $user->id;
            $entrenador->description = $request->input('description');

            if (request()->hasFile('image_profile'))//---> Valida que la imagen sea un archivo
            {
                $file = $request->file('image_profile');//---> asignamos a $file el valor de lo que traemos del request como imagen
                $extension = $file->getClientOriginalExtension();//---> asigmanos a $extension la extencion del archivo
                $file_profile = time()."-".$request->input('name').".".$extension;//---> armamos el nombre del archivo
                Storage::disk('entrenador')->put($file_profile, file_get_contents($file));//---> guardamos el archivo en el storage
            }

            $entrenador->image_profile = strval("/img/entrenador/".$file_profile);

            //dd($entrenador);

          if($entrenador->save()) {
              
            return new EntrenadorResource($entrenador);
          }


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
        $entrenador = Entrenador::findOrFail($id);
        return new EntrenadorResource($entrenador);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Entrenadores.edit',compact('user'));
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
                    'email.required' => 'Escriba un correo Electrónico',
                    'email.required' => 'Escriba un correo Electrónico con el formato correcto',
                    'description.required' => 'Escriba una descripción',
                    'image_profile.required' => 'Elija una Imagen',
                    'image_profile.file' => 'Elija una Imagen que sea un archivo',
                    'image_profile.max' => 'Elija una Imagen que menor de 20 mb',
                    'image_profile.mimes' => 'Elija una Imagen con la extención: jpeg o png',
                ];
          
                // * Reglas del validador
                $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email:rfc,dns',
                'description' => 'required',
                'image_profile' => 'file|max:20000|mimes:jpeg,png',
                ], $messages);
          
                // * Lo que suscede si el validador falla
                if ($validator->fails()) {
          
                  $errors = $validator->errors();
          
                  return ['data' => ['errors' => $errors]];
        
                }
          
          
                
                
                // * Ya que paso el validador, se crea un paquete con los datos del request
          
                $user = User::findOrFail($request->input('user_id'));
          
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                if($request->input('password')){
                    $user->password = bcrypt($request->input('password'));
                }
                $user->isAdmin = 1;
                //dd($user);
        
                if($user->save()) {
                    
                    $entrenador = Entrenador::findOrFail($request->input('entrenador_id'));
        
                    $entrenador->user_id = $user->id;
                    $entrenador->description = $request->input('description');
        

                    if (request()->hasFile('image_profile'))//---> Valida que la imagen sea un archivo
                    {
                        $file = $request->file('image_profile');//---> asignamos a $file el valor de lo que traemos del request como imagen
                        $extension = $file->getClientOriginalExtension();//---> asigmanos a $extension la extencion del archivo
                        $file_profile = str_replace("/img/entrenador/","",$entrenador->image_profile);//---> armamos el nombre del archivo
                        Storage::disk('entrenador')->put($file_profile, file_get_contents($file));//---> guardamos el archivo en el storage
                    }
                    
                  if($entrenador->save()) {
                    return new EntrenadorResource($entrenador);
                  }
        
        
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
}
