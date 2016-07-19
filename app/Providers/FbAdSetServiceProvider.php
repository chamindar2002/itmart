<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;
use Allison\Repositories\Contracts\IfFbAdSetRepository;
use Allison\Repositories\FbAdcampaign\FbAdSetRepository;

class FbAdSetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IfFbAdSetRepository::class, FbAdSetRepository::class);
    }
}
