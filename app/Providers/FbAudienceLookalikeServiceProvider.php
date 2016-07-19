<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;
use Allison\Repositories\Contracts\IfFbAudienceLookalike;
use Allison\Repositories\FbAudienceLookalike\FbAudienceLookalike;

class FbAudienceLookalikeServiceProvider extends ServiceProvider
{
    
     public function register()
    {
        $this->app->bind(IfFbAudienceLookalike::class, FbAudienceLookalike::class);
    }
    
}
