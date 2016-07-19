<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;

use Allison\Repositories\Contracts\IfFbAudiencePixel;
use Allison\Repositories\FbAudiencePixel\FbAudiencePixel;

class FbAudiencePixelServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(IfFbAudiencePixel::class, FbAudiencePixel::class);
    }
}
