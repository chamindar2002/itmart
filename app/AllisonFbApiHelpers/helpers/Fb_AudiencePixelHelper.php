<?php
namespace Allison\AllisonFbApiHelpers\helpers;

use Allison\AllisonFbApiHelpers\contracts\FbContract;

use FacebookAds\Object\AdsPixel;

use FacebookAds\Object\Fields\AdsPixelsFields;

use FacebookAds\Http\Exception\RequestException;

use Auth;

class Fb_AudiencePixelHelper extends FbContract{
    
    private $pixel; 
    
    public function init()
    {
        $this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
    }
    
    public function handleCreateRequest($request, $audience_pixel_helper){
         
        $this->pixel = new AdsPixel(null, $this->add_account_id);
        $this->pixel->{AdsPixelsFields::NAME} = $request->name;
        
        try {
           $this->pixel->create();
           
           return $this->pixel->id;
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }
        
        
    }
    
    public function handleUpdateRequest($request, $audience_pixel_helper, $pixel){
         
        
        $this->pixel = new AdsPixel($pixel->pixel_id, $this->add_account_id);
        $this->pixel->{AdsPixelsFields::NAME} = $request->name;
        
        try {
           $this->pixel->update();
           
           return true;
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }
        
        
    }
    
    public function fetchPixelCodeRequest($pixel_id){
        
        //dd($pixel_id);
        
        $this->pixel = new AdsPixel($pixel_id, $this->add_account_id);
       
        try {
            
           $this->pixel->read(array(AdsPixelsFields::CODE));
           
           return $this->pixel->{AdsPixelsFields::CODE}.PHP_EOL;
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }

        
        //dd($this->pixel);
                
    }
    
    
    public function handleReadRequest(){
        
        
            $appsecret_proof = hash_hmac('sha256', Auth::user()->fbProfile->access_token, Config('facebook.APP_SECRET')); 

            $params = array(
                    'access_token'=>Auth::user()->fbProfile->access_token,
                    'appsecret_proof'=>$appsecret_proof
            );
        
            $postdata = http_build_query($params);
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/v2.5/".$this->add_account_id."/adspixels?".$postdata);
            curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
            $header[] = 'Content-Type: text/xml; charset=UTF-8';
            //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
            curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
      
            $response = curl_exec($handle);
            
            //var_dump(json_decode($response)->error);
            if(isset(json_decode($response)->error)){
                //echo 'an error occured.';
                $this->exceptions = json_decode($response)->error->message;
                $this->handleRequestException();
                return false;
            }
            
            //die('cannot come here');
            return $response;
    }
}