<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DebugSessionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $sessionId = $request->getSession()->getId();
        $isAuthenticated = Auth::check();
        $userId = Auth::check() ? Auth::user()->id : null;
        $username = Auth::check() ? Auth::user()->username : null;

        // Log request start
        Log::debug('Session Debug - Request Start', [
            'path' => $request->path(),
            'method' => $request->method(),
            'session_id' => substr($sessionId, 0, 20) . '...',
            'authenticated' => $isAuthenticated,
            'user_id' => $userId,
            'username' => $username,
        ]);

        // Check if session exists in database
        if (config('session.driver') === 'database') {
            try {
                $sessionData = DB::table('sessions')
                    ->where('id', $sessionId)
                    ->first(['id', 'user_id', 'last_activity']);

                Log::debug('Session Debug - Database Status', [
                    'session_exists' => $sessionData ? true : false,
                    'db_user_id' => $sessionData?->user_id,
                    'last_activity' => $sessionData?->last_activity,
                ]);
            } catch (\Exception $e) {
                Log::error('Session Debug - DB Query Error: ' . $e->getMessage());
            }
        }

        $response = $next($request);

        // Log response
        Log::debug('Session Debug - Response', [
            'status_code' => $response->getStatusCode(),
            'session_id' => substr($sessionId, 0, 20) . '...',
        ]);

        return $response;
    }
}
