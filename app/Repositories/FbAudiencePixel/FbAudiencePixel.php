<?php
namespace Allison\Repositories\FbAudiencePixel;

use Allison\models\FbAudience\AudiencePixel;

use Allison\Repositories\Contracts\IfFbAudiencePixel;

use Auth;
/**
 * Description of FbAudiencePixel
 *
 * @author Efutures
 */
class FbAudiencePixel implements IfFbAudiencePixel{
    
    
    public function getAdAccountPixel()
    {
       if (Auth::user()->fbProfile) {
            
            //return Auth::user()->fbAdAccount->ad_account_id;
            return AudiencePixel::where('ad_account_id', Auth::user()->fbAdAccount->id)->get();
           
        }
    }

    public function create($request, $audience_pixel_helper)
    {
       $pixel_id = $audience_pixel_helper->handleCreateRequest($request, $audience_pixel_helper);
       
       if ($audience_pixel_helper->getExceptions() == null) {
           
           $pixel = new AudiencePixel();
           $pixel->name = $request->name;
           $pixel->user_id = Auth::user()->id;
           $pixel->ad_account_id = Auth::user()->fbAdAccount->id;
           $pixel->pixel_id = $pixel_id;
           
           if ($pixel->save()) {
                return true;
            }
           
       }
           
       return false;
    }

    public function getPixel($id)
    {
        return AudiencePixel::find($id);
    }

    public function update($request, $audience_pixel_helper, $id)
    {
        $pixel_id = $audience_pixel_helper->handleUpdateRequest($request, $audience_pixel_helper, $this->getPixel($id));
        
        if ($audience_pixel_helper->getExceptions() == null) {
           
           $pixel = $this->getPixel($id);
           $pixel->name = $request->name;
                      
           if ($pixel->save()) {
                return true;
            }
           
       }
       
       return false;
    }

    public function destroy($audience_pixel_helper, $id)
    {
        
    }
    
    public function getPixelByAdAccountId($ad_account_id){
        return AudiencePixel::where('ad_account_id', $ad_account_id)->first();
    }
    
    public function syncAudiencePixel($audience_pixel_helper){
        #if pixel not existing four current user ad account
        if(!$this->getPixelByAdAccountId(Auth::user()->fbAdAccount->id)){
            
            
            #fetch pixel id;
            if($audience_pixel_helper->handleReadRequest() != false){
                
                $response = json_decode($audience_pixel_helper->handleReadRequest());
                if(key_exists(0, $response->data)){

                    $pixel = new AudiencePixel();
                    $pixel->name = isset($response->data[0]->name) ? $response->data[0]->name : '';
                    $pixel->user_id = Auth::user()->id;
                    $pixel->pixel_id = $response->data[0]->id;
                    $pixel->ad_account_id = Auth::user()->fbAdAccount->id;
                    $pixel->save();

                    //dd($pixel);

                    return true;
                }
            }
            
        }
        
      return false;  
       
    }
    
    public function syncAudiencePixelCode($audience_pixel_helper, $audience_pixel){
        
        if($audience_pixel->pixel_code != ""){
            return false;
        }
        
        $pixel_code = $audience_pixel_helper->fetchPixelCodeRequest($audience_pixel->pixel_id);
       
        if ($audience_pixel_helper->getExceptions() == null) {
            
            $pixel = $this->getPixel($audience_pixel->id);
            $pixel->pixel_code = $pixel_code;
            
            if ($pixel->save()) {
                return true;
            }
            
        }
        
        return false;
        
    }
    
    public function listAudiencePixel(){
        $pixels = array();
        foreach($this->getAdAccountPixel() as $ap){
            $pixels[$ap->pixel_id] = $ap->name;
        }
        
        return $pixels;
    }
    
}
