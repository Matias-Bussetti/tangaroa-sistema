<?php

namespace App\Http\Middleware;

use Closure;

class ClientMiddleware
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
      //Si el usuario autenticado es cliente, déjalo pasar, y si no, redirígelo a la ruta principal.
      if (auth()->check() && auth()->user()->isAdmin == 0)
        return $next($request);

       //dd("sos clie");

      //dd("no sos clie");

      
      return redirect('/admin/settings');
    }
}
