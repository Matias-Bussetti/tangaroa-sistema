<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      //Si el usuario autenticado es administrador, déjalo pasar, y si no, redirígelo a la ruta principal.

      if (auth()->check() && auth()->user()->isAdmin == 1)
        return $next($request);

        //dd("sos adm");

      //dd("no sos adm");
        
      
      return redirect('/home');
    }
}
