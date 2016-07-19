<?php

namespace Allison\Http\Controllers\Auth;

use Allison\Http\Controllers\Controller;
use Allison\AllisonFbApiHelpers\helpers\Fb_Authenticate;
use Allison\Repositories\Contracts\IfFbprofilesRepository;
use Allison\Events\FbAuth\FbProfileUpdateEvent;
use Event;
use Illuminate\Http\Request;
use Auth;

class FbAccessTokenController extends Controller
{
    public function __construct(IfFbprofilesRepository $fb_profile)
    {
        $this->fb_profile = $fb_profile;
    }

    public function fetchAccessToken()
    {
        session_start();
        $fb_authenticate = new Fb_Authenticate();

        $url = $fb_authenticate->fetchTokenUrl();

        //var_dump( Auth::user()->fbProfile->access_token);
        
        //dd($fb_authenticate->getExceptions());

        return view('auth.fbtoken', compact('url'));
    }

    public function fetchTokenSuccess()
    {
        session_start();
        $fb_authenticate = new Fb_Authenticate();
        $fb_profile = $fb_authenticate->fetchFacebookProfile();
        

        //dd($fb_authenticate->dumpToken());
        if ($this->fb_profile->createOrUpdate($fb_profile, $fb_authenticate->dumpToken())) {
            if(Auth::user()->id != 1){
                Event::fire(new FbProfileUpdateEvent($fb_profile, $fb_authenticate));
            }
            return redirect('home');
        }
    }
}
