<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v2;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if($request->user()->role !== $role && $request->user()->role == 'user') {
            return redirect()->intended('user/index');
        }
        if($request->user()->role !== $role) {
            return redirect()->back();
        }
        return $next($request);
    }
}
