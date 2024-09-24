<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Check if the authenticated user has the required role
        if ($request->user() && $request->user()->hasRole('Pemilik')) {
            return $next($request);
        }

        // dd($role);

        // Redirect or respond with an error if the user doesn't have the required role
        return abort(404, 'Unauthorized action.');
    }
}
