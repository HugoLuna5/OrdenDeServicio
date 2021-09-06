<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RevisarRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->tipoUsuario != $role) {
             abort(403, "No tienes autorización para ingresar.");
        }



        return $next($request);
    }
}
