<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Check if user_id ada di session
        if (!session()->has('user_id')) {
            return redirect()->route('role.select');
        }

        $userRole = session('role');

        // Check if role sesuai dengan route requirement
        if (!in_array($userRole, $roles)) {
            // Map role ke route name (orangtua → orang-tua)
            $routePrefix = $userRole === 'orangtua' ? 'orang-tua' : $userRole;
            return redirect()->route($routePrefix . '.home')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
