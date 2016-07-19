<?php

namespace Allison\Listeners\FbAdSync;

use Allison\Events\FbAdSync\FbAdMediaReadEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncFbAdMedia
{
    public $fb_admedia;
    public $admedia_helper;
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
     * @param  FbAdMediaReadEvent  $event
     * @return void
     */
    public function handle(FbAdMediaReadEvent $event)
    {
        $this->fb_admedia = $event->fb_admedia;
        $this->admedia_helper = $event->admedia_helper;
        
        $this->fb_admedia->syncFbAdMedia($this->admedia_helper);
    }
}
