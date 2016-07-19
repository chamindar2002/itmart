<?php

namespace Allison\Providers;

use Illuminate\Support\ServiceProvider;
use Allison\Repositories\Contracts\IfFbAdcampaignsRepository;
use Allison\Repositories\FbAdcampaign\FbAdcampaignsRepository;

class FbAdCampaignServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IfFbAdcampaignsRepository::class, FbAdcampaignsRepository::class);
    }
}
