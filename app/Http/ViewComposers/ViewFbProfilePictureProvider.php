<?php

namespace Allison\Http\ViewComposers;

use Illuminate\Support\ServiceProvider;
use Auth;

class ViewFbProfilePictureProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        dd(Auth::user()->id);
        $this->composeFbProfilePicture();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    private function composeFbProfilePicture(){
        //$profile_picture = '';
        $profile_picture = Auth::check();
        //dd($profile_picture);
        if(Auth::user()){
            
             $profile_picture = Auth::user()->fbProfile->facebook_id;
             view()->composer('partials.nav',function($view)
             {
                $view->with('profile_picture', $profile_picture);
             });
        
        }
    }
}
