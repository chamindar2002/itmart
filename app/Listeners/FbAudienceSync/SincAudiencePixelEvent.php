<?php

namespace Allison\Listeners\FbAudienceSync;

use Allison\Events\FbAudienceSync\AudiencePixelReadEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class SincAudiencePixelEvent
{
    protected $fb_audience_pixel;
    
    protected $audience_pixel_helper;
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
     * @param  AudiencePixelReadEvent  $event
     * @return void
     */
    public function handle(AudiencePixelReadEvent $event)
    {
        $this->fb_audience_pixel = $event->fb_audience_pixel;
        $this->audience_pixel_helper = $event->audience_pixel_helper;
        
        $this->fb_audience_pixel->syncAudiencePixel($this->audience_pixel_helper);
    }
}
