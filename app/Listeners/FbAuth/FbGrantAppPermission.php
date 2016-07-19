<?php

namespace Allison\Listeners\FbAuth;

use Allison\Events\FbAuth\FbProfileUpdateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class FbGrantAppPermission
{
    protected $request;
    protected $fb_authenticate;
    protected $fb_profile; 


    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FbProfileUpdateEvent  $event
     * @return void
     */
    public function handle(FbProfileUpdateEvent $event)
    {
        $this->request = $event->request;
        $this->fb_authenticate = $event->fb_authenticate;
        $this->fb_profile = $event->fb_profile;
        
        
        //$this->fb_authenticate->grantFbAppAccessCommand($this->fb_profile->getAdminToken(), $this->request);
        //die('listening');
    }
}
