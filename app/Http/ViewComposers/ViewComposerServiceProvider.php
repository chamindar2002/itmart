<?php

namespace Allison\Http\ViewComposers;

use Illuminate\Support\ServiceProvider;
use Allison\models\FbAd\AdTargetSearchCache;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Auth;
use Session;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->composeInterestsResults();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }

    private function composeInterestsResults()
    {
        view()->composer('admanager.adset._interests', function ($view) {
            $results = AdTargetSearchCache::where('user_id', Auth::user()->id)
                                                 ->orderBy('updated_at', 'desc')
                                                 ->first();

            $data = Fb_AdUtilities::unserialize_data($results->search_results);

            #session variable 'last_target_search_id' set usin a middleware FbTargetSearchCache
            $search_target_id = Session::get('last_target_search_id') ? Session::get('last_target_search_id') : '';

            $view->with(
                    array(
                        'results' => $data,
                        'search_target_id' => $search_target_id,
            ));
        });
    }
}
