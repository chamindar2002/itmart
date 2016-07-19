<?php

namespace Allison\Listeners\FbAudienceSync;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Allison\Events\FbAudienceSync\AudienceCustomReadEvent;

class SincAudienceCustomEvent
{
    public $fb_audience_custom;
    
    public $audience_custom_helper;
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
     * @param  AudienceCustomReadEvent  $event
     * @return void
     */
    public function handle(AudienceCustomReadEvent $event)
    {
        $this->fb_audience_custom = $event->fb_audience_custom;
        $this->audience_custom_helper = $event->audience_custom_helper;
        
        $this->fb_audience_custom->syncAudienceCustom($this->audience_custom_helper);
    }
}
