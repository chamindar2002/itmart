<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;

use Allison\Repositories\Contracts\IfFbAdCreativeRepository;
use Allison\Repositories\FbAdCreative\FbAdCreativeRepository;

class FbAdCreativeServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(IfFbAdCreativeRepository::class, FbAdCreativeRepository::class);
    }
}
