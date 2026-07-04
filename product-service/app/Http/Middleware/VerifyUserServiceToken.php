<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class VerifyUserServiceToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Unauthorized - No Token Provided'], 401);
        }

        $userServiceUrl = env('USER_SERVICE_URL', 'http://127.0.0.1:8001');
        
        try {
            $response = Http::withToken($token)->get($userServiceUrl . '/api/user');

            if ($response->successful()) {
                return $next($request);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'User Service Unavailable'], 503);
        }

        return response()->json(['error' => 'Unauthorized - Invalid Token'], 401);
    }
}
