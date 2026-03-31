<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogSessionActivity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Log session activity untuk debugging
        if (Auth::check()) {
            try {
                DB::table('sessions')
                    ->where('id', $request->getSession()->getId())
                    ->update([
                        'user_id' => Auth::user()->id,
                        'ip_address' => $request->ip(),
                        'user_agent' => substr($request->userAgent(), 0, 500),
                        'last_activity' => now()->timestamp,
                    ]);

                Log::debug('Session activity logged', [
                    'user_id' => Auth::user()->id,
                    'username' => Auth::user()->username,
                    'path' => $request->path(),
                    'method' => $request->method(),
                ]);
            } catch (\Exception $e) {
                Log::error('Session logging error: ' . $e->getMessage());
            }
        }

        return $response;
    }
}
