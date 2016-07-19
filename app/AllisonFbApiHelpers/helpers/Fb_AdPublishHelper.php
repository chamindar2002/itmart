<?php
namespace Allison\AllisonFbApiHelpers\helpers;

use Allison\AllisonFbApiHelpers\contracts\FbContract;

use FacebookAds\Api;
use FacebookAds\Object\Ad;
use FacebookAds\Object\Fields\AdFields;

use FacebookAds\Http\Exception\RequestException;

class Fb_AdPublishHelper extends FbContract{
   
    private $ad;

    public function init()
    {
       
        $this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
        
    }
    
    public function handleCreateRequest($request, $fb_adset, $fb_adcreative){
        
        
        $adcreative = $fb_adcreative->getAdCreative($request->ad_creative_id);
        $adset = $fb_adset->getAdSet($request->ad_set_id);
        $status = $request->status != '' ? Fb_AdUtilities::popStatus($request->status) : 'PAUSED';
        
        //dd($status);
        /*dd($request->name);
        dd($adcreative->ad_creative_id);
        dd($adset->ad_set_id);*/
        
       
        $this->ad = new Ad(null, $this->add_account_id);
        $this->ad->setData(array(
          AdFields::CREATIVE =>array('creative_id' => $adcreative->ad_creative_id),
          AdFields::NAME => $request->name,
          AdFields::ADSET_ID => $adset->ad_set_id,
    
         ));
            
        try{
            $this->ad->create(
                    array(Ad::STATUS_PARAM_NAME => $status,)
                    );
           
             return $this->ad->id;
            
        }catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        
    //return '1234567890';
    }
    
    public function handleUpdateRequest($ad, $request)
    {
        
        return true;
    }
    
    public function handleDeleteRequest($ad)
    {
       
        return true;
    }
    
}
