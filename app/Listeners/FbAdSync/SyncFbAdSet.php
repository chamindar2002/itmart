<?php

namespace Allison\Listeners\FbAdSync;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Allison\Events\FbAdSync\FbAdSetReadEvent;

class SyncFbAdSet
{
    public $fb_adset;
    public $adset_helper;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FbAdSetReadEvent  $event
     * @return void
     */
    public function handle(FbAdSetReadEvent $event)
    {
        $this->fb_adset = $event->fb_adset;
        $this->adset_helper = $event->adset_helper;
        
        $this->fb_adset->syncFbAdSet($this->adset_helper);
    }
}
