<?php

namespace Allison\Http\Middleware;

use Closure;
use Allison\AllisonFbApiHelpers\helpers\Fb_AccessTokenValidator;

class VerifyFBAccessToken
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
        $fb = new Fb_AccessTokenValidator();
        if (!$fb->tokenExists()) {
            #if no facebook access token redirect fetch-token 
            return redirect()->guest('fetch-token');
        }

        return $next($request);
    }
}
