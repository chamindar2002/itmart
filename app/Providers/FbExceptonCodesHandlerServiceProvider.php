<?php
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 6/14/16
 * Time: 4:38 PM
 */

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;
use Allison\AllisonFbApiHelpers\contracts\IfFbExceptionCodeHandler;
use Allison\AllisonFbApiHelpers\helpers\Fb_ExceptionCodesHandler;
use Symfony\Component\HttpFoundation\Request;

class FbExceptonCodesHandlerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(IfFbExceptionCodeHandler::class, function()
        {
            $request = app(\Illuminate\Http\Request::class);
            //dd($request->code);
            return new Fb_ExceptionCodesHandler($request->code);
        });
    }


}