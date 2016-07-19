<?php

namespace Allison\Http\Middleware;

use Closure;
use Session;

class FbTargetSearchCache
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isset($request->target_id) && $request->target_id != '') {
            Session::set('last_target_search_id', $request->target_id);
        }

        return $next($request);
    }
}
