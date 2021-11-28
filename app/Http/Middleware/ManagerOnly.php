<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ManagerOnly
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
        $accept = array(
            'manager' => true,
            'admin' => true,
            'student' => false,
        );
        if ($accept[Auth::user()->role]) {
            return $next($request);
        }
        return response('', 403);
    }
}
