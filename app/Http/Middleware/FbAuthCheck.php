<?php

namespace Allison\Http\Middleware;

use Closure;

use Auth;

use Allison\Exceptions\FbException;

class FbAuthCheck
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
        if(!Auth::user()){

            throw new FbException('Sorry. Looks like your login session has epired :(', null);
        }


        return $next($request);
    }
}
