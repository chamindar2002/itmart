<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;

use Allison\Repositories\Contracts\IfFbAdProductsRepository;

use Allison\Repositories\FbProducts\FbAdProductsRepository;

class FbAdProductServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(IfFbAdProductsRepository::class, FbAdProductsRepository::class);

    }

}
