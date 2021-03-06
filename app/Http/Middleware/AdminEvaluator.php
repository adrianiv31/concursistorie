<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminEvaluator
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

            if (Auth::user()->isEvaluator()||Auth::user()->isAdmin()) {

                return $next($request);

            } else
                return redirect('/');

        }

        return redirect('/');
    }
}
