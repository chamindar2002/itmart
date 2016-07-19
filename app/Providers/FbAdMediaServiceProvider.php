<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;

use Allison\Repositories\Contracts\IfFbAdMediaRepository;

use Allison\Repositories\FbAdmedia\FbAdMediaRepository;

class FbAdMediaServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        
        $this->app->bind(IfFbAdMediaRepository::class, FbAdMediaRepository::class);
        
    }
    
}
