<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
      if( \Auth::check() && \Auth::user()->isAdmin()){
        return $next($request);
      }
      return redirect('dashboard')->with('danger', 'You are not allowed to view this page.');
    }
}
