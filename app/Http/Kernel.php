<?php

namespace Allison\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Allison\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Allison\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Allison\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Allison\Http\Middleware\RedirectIfAuthenticated::class,
        'fb.acess-token' => \Allison\Http\Middleware\VerifyFBAccessToken::class,
        'fb.ad-account' => \Allison\Http\Middleware\VerifyFbAdAccount::class,
        'fb.audience-selector' =>  \Allison\Http\Middleware\FbAudience\CustomAudienceSelector::class,
        'fb.adcreative-selector' => \Allison\Http\Middleware\FbAd\AdCreativeSelector::class,
        'fb.auth-check'=> \Allison\Http\Middleware\FbAuthCheck::class,
        //'fb.target-search' => \Allison\Http\Middleware\FbTargetSearchCache::class
    ];
}
