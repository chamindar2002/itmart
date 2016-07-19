<?php

namespace Allison\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'Allison\Events\SomeEvent' => [
//            'Allison\Listeners\EventListener',
//        ],
        'Allison\Events\FbAudienceSync\AudiencePixelReadEvent' => [
            'Allison\Listeners\FbAudienceSync\SincAudiencePixelEvent',
            
        ],
        
        'Allison\Events\FbAuth\FbProfileUpdateEvent' => [
            'Allison\Listeners\FbAuth\FbGrantAppPermission',
            
        ],
        
        'Allison\Events\FbAudienceSync\AudienceCustomReadEvent' => [
            'Allison\Listeners\FbAudienceSync\SincAudienceCustomEvent',
            
        ],
        
        'Allison\Events\FbAdSync\FbAdSetReadEvent' => [
            'Allison\Listeners\FbAdSync\SyncFbAdSet',
        ],  
        
        'Allison\Events\FbAdSync\FbAdMediaReadEvent' => [
            'Allison\Listeners\FbAdSync\SyncFbAdMedia',
        ],  
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $events->listen('App\Events\FbAudienceSync\AudiencePixelReadEvent',
                    'App\Listeners\FbAudienceSync\SincAudiencePixelEvent');
        
        $events->listen('App\Events\FbAuth\FbProfileUpdateEvent',
                    'App\Listeners\FbAuth\FbGrantAppPermission');
        
        $events->listen('App\Events\FbAudienceSync\AudienceCustomReadEvent',
                    'App\Listeners\FbAudienceSync\SincAudienceCustomEvent');
        
        $events->listen('Allison\Events\FbAdSync\FbAdSetReadEvent',
                    'Allison\Listeners\FbAdSync\SyncFbAdSet');
        
        $events->listen('Allison\Events\FbAdSync\FbAdMediaReadEvent',
                    'Allison\Listeners\FbAdSync\SyncFbAdMedia');
    }
}
