<?php

namespace App\Http\Middleware;

use App\Data\Repositories\Routines as RoutinesRepository;
use Closure;
use Illuminate\Http\Request;

class MustHaveOpenedRoutine
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routine_id = $request->get('routine_id')
            ? $request->get('routine_id')
            : \Route::getCurrentRoute()->parameters('routine_id');

        if ($routine = app(RoutinesRepository::class)->findById($routine_id)) {
            if (!$routine->status) {
                abort(403, 'Rotina não está aberta.');
            }
        }

        return $next($request);
    }
}
