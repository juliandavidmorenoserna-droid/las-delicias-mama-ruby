<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    /**
     * Verificar que el usuario autenticado tiene el rol permitido.
     *
     * Uso en rutas:
     *   ->middleware('rol:admin')
     *   ->middleware('rol:empleado')
     *   ->middleware('rol:cliente')
     *   ->middleware('rol:admin,empleado')   ← acepta varios roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Si no está autenticado, redirigir al login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder a esta sección.');
        }

        $usuario = Auth::user();

        // Verificar si el rol del usuario está en la lista de roles permitidos
        if (!in_array($usuario->rol, $roles)) {
            // Redirigir según el rol real del usuario
            return match ($usuario->rol) {
                'cliente'  => redirect()->route('cliente.menu')
                                ->with('error', '⛔ No tienes permiso para acceder a esa sección.'),
                'empleado' => redirect()->route('empleado.mesas')
                                ->with('error', '⛔ No tienes permiso para acceder a esa sección.'),
                default    => redirect()->route('inicio')
                                ->with('error', '⛔ No tienes permiso para acceder a esa sección.'),
            };
        }

        return $next($request);
    }
}
