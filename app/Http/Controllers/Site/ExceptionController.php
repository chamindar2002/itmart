<?php

namespace Allison\Http\Controllers\Site;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;
use Auth;
use Allison\AllisonFbApiHelpers\helpers\Fb_Authenticate;
use Allison\models\FbProfile;
use Illuminate\Support\Facades\URL;
use Session;
use Allison\Events\FbAuth\FbProfileUpdateEvent;
use Allison\Repositories\Contracts\IfFbprofilesRepository;
use Allison\AllisonFbApiHelpers\contracts\IfFbExceptionCodeHandler;

class ExceptionController extends Controller
{

    public function __construct(IfFbprofilesRepository $fb_profile, IfFbExceptionCodeHandler $error_code_handler)
    {
        $this->fb_profile = $fb_profile;
        $this->error_code_handler = $error_code_handler;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        Session::put('redirect_url', URL::previous());
        return View('site.exception',  compact('code'));
        
    }
    
    public function sendAppPermissionRequest(Request $request)
    {
       $access_token =  Auth::user()->fbProfile->access_token;
       $fb_admin_profile = FbProfile::getAdminProfile();
       
       //dd(Auth::user()->fbProfile);
       $authenticate = new Fb_Authenticate();
       $result = $authenticate->grantFbAppAccessCommand($fb_admin_profile->access_token, Auth::user()->fbProfile);
       // $this->fb_profile = new FbprofileRepository();
       //dd($result);
       if(property_exists($result,'success')){
           
           echo 'Success : <a href="https://developers.facebook.com/requests/" target="new">Confirm App Access Permission</a>';
           
       }elseif(property_exists($result,'error')){

           //$request->request->add(['code' => $result->error->error_subcode]);
           //dd($request);
           $this->error_code_handler->setErrorCode($result->error->error_subcode);
           $this->error_code_handler->setMessage($result->error->message);

           echo $this->error_code_handler->handle();


       }else{
           
           echo 'Error';
       }
    }

    public function resetFbAccessToken(){


        if($this->fb_profile->resetUserFbAccessToken())
        {
            return json_encode(true);
        }

        return json_encode(false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
