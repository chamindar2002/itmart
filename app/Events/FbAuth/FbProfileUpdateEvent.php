<?php

namespace Allison\Events\FbAuth;

use Allison\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Allison\Repositories\Fbprofile\FbprofileRepository;

class FbProfileUpdateEvent extends Event
{
    use SerializesModels;

    public $request;
    public $fb_authenticate;
    public $fb_profile; 
    
    public function __construct($request, $fb_authenticate)
    {
        $this->request = $request;
        $this->fb_authenticate = $fb_authenticate;
        $this->fb_profile = new FbprofileRepository();
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
