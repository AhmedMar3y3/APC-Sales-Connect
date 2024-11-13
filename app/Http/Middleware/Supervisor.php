<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Supervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supervisor = Auth::guard('supervisor')->user();
        
        if (!$supervisor || !$supervisor->email) {
            return response()->json(['message' => 'Unauthorized: Only supervisors can access this route'], 403);
        }

        return $next($request);

    }
}
