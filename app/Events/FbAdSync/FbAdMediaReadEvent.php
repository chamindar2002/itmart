<?php

namespace Allison\Events\FbAdSync;

use Allison\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FbAdMediaReadEvent extends Event
{
    use SerializesModels;
    
    public $fb_admedia;
    public $admedia_helper;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($fb_admedia, $admedia_helper)
    {
        $this->fb_admedia = $fb_admedia;
        $this->admedia_helper = $admedia_helper;
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
