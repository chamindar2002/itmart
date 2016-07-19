<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;

use Allison\Repositories\Contracts\IfFbAdPublishRepository;

use Allison\Repositories\FbAd\FbAdPublishRepository;

class FbAdPublishServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(IfFbAdPublishRepository::class, FbAdPublishRepository::class);
    }
}
