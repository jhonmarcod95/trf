<?php

namespace App\Http\Middleware;

use Closure;

class approver
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
        
        if ($request->user() && $request->user()->role != 3)
        {
            dd($request->user()->role);
            return redirect('/');
        }
        return $next($request);
    }
}
