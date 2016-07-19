<?php

namespace Allison\Events\FbAudienceSync;

use Allison\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AudienceCustomReadEvent extends Event
{
    use SerializesModels;
    
    public $fb_audience_custom;
    public $audience_custom_helper;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($fb_audience_custom, $audience_custom_helper)
    {
        $this->fb_audience_custom = $fb_audience_custom;
        $this->audience_custom_helper = $audience_custom_helper;
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
