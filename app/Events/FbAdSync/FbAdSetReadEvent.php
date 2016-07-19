<?php

namespace Allison\Events\FbAdSync;

use Allison\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FbAdSetReadEvent extends Event
{
    use SerializesModels;
    
    public $fb_adset;
    public $adset_helper;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($fb_adset, $adset_helper)
    {
        $this->fb_adset = $fb_adset;
        $this->adset_helper = $adset_helper;
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
