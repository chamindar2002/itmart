<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;
use Allison\Repositories\Contracts\IfFbprofilesRepository;
use Allison\Repositories\Fbprofile\FbprofileRepository;

class FbProfilesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IfFbprofilesRepository::class, FbprofileRepository::class);
    }
}
