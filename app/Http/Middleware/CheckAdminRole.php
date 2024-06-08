<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle($request, Closure $next)
    {
        // Permitir acceso a la ruta de cierre de sesión
        if ($request->is('admin/logout')) {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->hasRole('administrador')) {
            return $next($request);
        }

        return abort(403, 'No tienes permiso para acceder a esta página');
    }
}
