<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = '')
    {
        $userRole = ($request->user()->hasRole())->role_name;

        if ($userRole != $role) {
            return response()->json(
                ['error' => 'You do not have permission to access this services'],
                403
            );
        }
        return $next($request);
    }
}
