<?php

namespace App\Http\Middleware;

use Closure;

class PossibleModifiedDeviceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $device = \App\Device::findOrFail($request->id);
        if ($device->available != true) {
            return response()->json(
                ['error' => 'You can not change this resource because it unavaible now.'],
                409
            );
        }
        return $next($request);
    }
}
