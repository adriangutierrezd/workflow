<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
    
        foreach ($roles as $role) {
            if ($request->user()->role->name != $role) {
                abort(403, 'Acceso no autorizado.');
            }
        }
    
        return $next($request);
    }
    
}
