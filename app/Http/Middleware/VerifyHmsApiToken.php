<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyHmsApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = config('hms.api_token');

        if (! is_string($token) || $token === '') {
            abort(503, 'HMS API is not configured.');
        }

        $bearer = $request->bearerToken();

        if ($bearer === null || ! hash_equals($token, $bearer)) {
            abort(401, 'Invalid API token.');
        }

        return $next($request);
    }
}
