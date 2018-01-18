<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminEditor
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
        if (Auth::check()) {

            if (Auth::user()->isEditor()||Auth::user()->isAdmin()) {

                return $next($request);

            } else
                return redirect('/');

        }

        return redirect('/');
    }
}
