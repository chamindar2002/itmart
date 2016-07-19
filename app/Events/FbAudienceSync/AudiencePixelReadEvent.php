<?php

namespace Allison\Events\FbAudienceSync;

use Allison\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class AudiencePixelReadEvent extends Event
{
    use SerializesModels;

    public $fb_audience_pixel;
    
    public $audience_pixel_helper;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($fb_audience_pixel, $audience_pixel_helper)
    {
       $this->fb_audience_pixel = $fb_audience_pixel;
       $this->audience_pixel_helper = $audience_pixel_helper;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}