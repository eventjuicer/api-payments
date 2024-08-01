<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CheckXToken
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('x-token') !== env('X_TOKEN')) {
            return Response::json([
                'error' => [
                    'code' => 401,
                    'message' => 'Token missing or invalid... set x-token in request header or via url param'
                ]
            ], 401);
        }

        return $next($request);
    }
}
