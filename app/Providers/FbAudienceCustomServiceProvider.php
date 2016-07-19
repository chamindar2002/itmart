<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;

use Allison\Repositories\Contracts\IfFbAudienceCustom;
use Allison\Repositories\FbAudienceCustom\FbAudienceCustom;

class FbAudienceCustomServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IfFbAudienceCustom::class, FbAudienceCustom::class);
    }
}
