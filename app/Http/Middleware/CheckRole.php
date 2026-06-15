<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware para restringir accesos según roles.
 */
class CheckRole
{
    /**
     * Valida el rol del usuario autenticado.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role Rol exigido (admin o cliente).
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /** @var \App\Models\Usuario|null $user */
        $user = Auth::user();

        if (!Auth::check() || $user->rol !== $role) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);
    }
}


