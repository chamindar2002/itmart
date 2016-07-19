<?php

namespace Allison\Http\Middleware;

use Closure;

use Auth;

class VerifyFbAdAccount
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
        if (!isset(Auth::user()->fbAdAccount->ad_account_id)) {

            return redirect()->guest('create-ad-account');
        }
        return $next($request);
    }
}
