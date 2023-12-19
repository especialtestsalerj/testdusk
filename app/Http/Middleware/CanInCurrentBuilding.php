<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanInCurrentBuilding
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        foreach ($abilities as $ability) {
            if (allows_in_current_building($ability)) {
                return $next($request);
            }
        }

        abort(403);
    }
}
