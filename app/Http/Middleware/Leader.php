<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Leader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $leader = Auth::guard('leader')->user();
        
        if (!$leader || !$leader->email) {
            return response()->json(['message' => 'Unauthorized: Only leaders can access this route'], 403);
        }

        return $next($request);
    }
}
