<?php

namespace Allison\AllisonFbApiHelpers\helpers;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Allison\AllisonFbApiHelpers\contracts\FbContract;
/**
 * Description of Fb_Authenticate.
 *
 * @author Chaminda
 */
class Fb_Authenticate extends FbContract
{
    private $login_url;

    protected $fb;

    #User's (current) Access token
    protected $access_token;

    #Messages incurred from exeption handling
    //protected $exceptions;

    #Add Acount Id 
    protected $add_account_id;
    
    protected $permissions = ['ads_management', 'ads_read', 'email', 'publish_pages','user_birthday',
        'publish_actions',
        'publish_pages',
        'manage_pages',
        'public_profile',];
    
    protected $redirect_url = 'Auth\FbAccessTokenController@fetchTokenSuccess';

//    public function __construct()
//    {
//        $this->init();
//    }
     

    public function init()
    {
        try {
            $this->fb = new Facebook([
                    'app_id' => Config('facebook.APP_ID'),
                    'app_secret' => Config('facebook.APP_SECRET'),
                  ]);
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
              $this->exceptions = 'Graph returned an error: '.$e->getMessage();
            die($this->exceptions);
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
              $this->exceptions = 'Facebook SDK returned an error: '.$e->getMessage();
            die($this->exceptions);
        }
        
        //$this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
    }

    public function fetchTokenUrl()
    {
        $this->handleCall();

        return $this->login_url;
    }

    public function dumpToken()
    {
        $this->handleCall();

        return $this->access_token;
    }

    private function handleCall()
    {
        $helper = $this->fb->getRedirectLoginHelper();

        if (!isset($_SESSION['facebook_access_token'])) {
            $_SESSION['facebook_access_token'] = null;
        }

        if (!$_SESSION['facebook_access_token']) {
            $helper = $this->fb->getRedirectLoginHelper();
            try {
                $_SESSION['facebook_access_token'] = (string) $helper->getAccessToken();
            } catch (FacebookResponseException $e) {
                // When Graph returns an error
              $this->exceptions = 'Graph returned an error: '.$e->getMessage();
                exit;
            } catch (FacebookSDKException $e) {
                // When validation fails or other local issues
              $this->exceptions = 'Facebook SDK returned an error: '.$e->getMessage();
                exit;
            }
        }
        
        //$permissions = ['ads_management', 'ads_read', 'email'];
        $url = action($this->redirect_url);

        if ($_SESSION['facebook_access_token']) {
            $this->exceptions = 'You are logged in!';
            $this->access_token = $_SESSION['facebook_access_token'];
            
            $this->login_url = $helper->getLoginUrl($url, $this->permissions);
            
        } else {
            //$permissions = ['ads_management', 'ads_read', 'email'];

            $this->login_url = $helper->getLoginUrl($url, $this->permissions);
        }
    }

    public function fetchFacebookProfile()
    {
        $this->handleCall();
        if ($this->access_token) {
            $appsecret_proof = hash_hmac('sha256', $this->access_token, Config('facebook.APP_SECRET'));

            $params = array(
                    'access_token' => $this->access_token,
                    'fields' => 'id,email,name,gender',
                    //'fields' => 'id',
                    'appsecret_proof' => $appsecret_proof,
             );

            $postdata = http_build_query($params);
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_URL, 'https://graph.facebook.com/me?'.$postdata);
            curl_setopt($handle, CURLOPT_VERBOSE, true);
            $header[] = 'Content-Type: text/xml; charset=UTF-8';
            //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
            curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

            $response = json_decode(curl_exec($handle));
            if (isset($response->error)) {
                #if error an object will be thrown
                $this->exceptions = $response->error->message;
            } elseif (isset($response->id)) {
                #if response has id attribute indicates that return was successfull
                return $response;
            }

            #has to handle this properly later
            die('an error occured 92732937 : '.$this->exceptions);
        }
    }

//    final public function getExceptions()
//    {
//        return $this->exceptions;
//    }
    
    
    public function grantFbAppAccessCommand($access_token, $fb_profile){


        #doc -> https://developers.facebook.com/docs/graph-api/reference/v2.5/app/roles
        $appsecret_proof= hash_hmac('sha256', $access_token, Config('facebook.APP_SECRET')); 
        
       $params = array(
                'access_token'=>$access_token,
                'appsecret_proof'=>$appsecret_proof
         );
       
       //dd($params);
        
        $user_id = $fb_profile->facebook_id; #user id of the user to be gratend role (690494351 myself)
        $role = 'developers'; //roles : 'administrators', 'developers', 'testers', 'insights users'
       
            $postdata = http_build_query($params);
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/v2.5/".Config('facebook.APP_ID')."/roles?user=$user_id&role=$role&".$postdata);
            curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
            $header[] = 'Content-Type: text/xml; charset=UTF-8';
            //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
            curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
      
            $response = curl_exec($handle);

            //dd($response);
            //log if errors
            $response = json_decode($response);
           
            if(property_exists($response,'error')){
                
                $this->exceptions = 'Caught Exception: '.$response->error->message.' Code: '.$response->error->code.' Action=>Fb_Authenticate/grantFbAppAccessCommand()';
                $this->handleRequestException();
            
            }
            
            return $response;
            //die("https://graph.facebook.com/v2.5/".Config('facebook.APP_ID')."/roles?user=$user_id&role=$role&".$postdata);
            //dd($response);
            
    }
}
