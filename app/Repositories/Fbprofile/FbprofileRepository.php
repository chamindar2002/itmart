<?php

namespace Allison\Repositories\Fbprofile;

use Allison\Repositories\Contracts\IfFbprofilesRepository;
use Allison\models\FbProfile;
use Auth;

/**
 * Description of FbprofileRepository.
 *
 * @author Oracle
 */
class FbprofileRepository implements IfFbprofilesRepository
{
    public function getAllProfiles()
    {
        return FbProfile::all();
    }

    public function getProfile($id)
    {
        return FbProfile::find($id);
    }

    public function createOrUpdate($request, $access_token, $id = null)
    {
        
              
        //if (is_null($id)) {
        if($this->emailExists($request->email) == null){
            $fb_profile = new FbProfile();
            $fb_profile->user_id = Auth::User()->id;
            $fb_profile->email = isset($request->email) ? $request->email : Auth::User()->email;
            $fb_profile->facebook_id = $request->id;
            $fb_profile->name = $request->name;
            $fb_profile->gender = isset($request->gender) ? $request->gender : '';
            $fb_profile->access_token = $access_token;

            if ($fb_profile->save()) {
                return true;
            }
        } else {
            
            $fb_profile = $this->emailExists($request->email);
            //$fb_profile->user_id = Auth::User()->id;
            //$fb_profile->email = isset($request->email) ? $request->email : Auth::User()->email;
            $fb_profile->facebook_id = $request->id;
            $fb_profile->name = $request->name;
            $fb_profile->gender = isset($request->gender) ? $request->gender : '';
            $fb_profile->access_token = $access_token;

            if ($fb_profile->save()) {
                return true;
            }
                #implement update if required later
                   // exit();
        }

        return false;
    }
    
    public function getAdminToken(){
        
        $admin = FbProfile::findOrFail(1);
        return $admin->access_token;
        
    }
    
    public function emailExists($email=null){
        
        if($email == null){
            $email = Auth::User()->email;
        }
        
        
        return FbProfile::where('email', $email)->first();
        
        
    }

    public function resetUserFbAccessToken(){
        $profile = $this->getProfile(Auth::user()->fbProfile->id);
        $profile->access_token = '';

        if ($profile->save()) {
            return true;
        }
        return false;
    }
}
