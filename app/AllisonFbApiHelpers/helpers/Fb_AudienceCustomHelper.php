<?php
namespace Allison\AllisonFbApiHelpers\helpers;

use FacebookAds\Object\CustomAudience;
use FacebookAds\Object\Fields\CustomAudienceFields;
use FacebookAds\Object\Values\CustomAudienceSubtypes;
use Allison\AllisonFbApiHelpers\contracts\FbContract;
use FacebookAds\Http\Exception\RequestException;
use Allison\AllisonFbApiHelpers\helpers\Fb_AudienceUtilities;
use FacebookAds\Object\AdAccount;

/**
 * Description of Fb_AudienceCustomHelper
 *
 * @author Efutures
 */
class Fb_AudienceCustomHelper extends FbContract{
    
    private $custom_audience; 
    private $ad_account;
    
    public function init()
    {
        $this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
    }
    
    public function handleDeleteRequest($audience_custom)
    {
        $this->custom_audience = new CustomAudience($audience_custom->audience_id, $this->add_account_id);
        
        try {
           $this->custom_audience->delete();
           
           //return $this->custom_audience->id;
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }
    }
    
    public function handleUpdateRequest($request, $audience_custom)
    {
        $this->custom_audience = new CustomAudience($audience_custom->audience_id, $this->add_account_id);
        $this->prepareData($request);
        
         
        try {
           $this->custom_audience->update();
           
           return $this->custom_audience;
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }
    }
    
    public function handleCreateRequest($request){
         
        //dd($request);
         
         $this->custom_audience = new CustomAudience(null, $this->add_account_id);
         $this->prepareData($request);
         
         
        try {
           $this->custom_audience->create();
           
           return $this->custom_audience;
           //return $this->custom_audience->id;
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }
     }
     
     private function prepareData($request){
         
        $this->custom_audience->setData(array(
                       CustomAudienceFields::PIXEL_ID => $request->pixel_id,
                       CustomAudienceFields::NAME => $request->name,
                       CustomAUdienceFields::DESCRIPTION => $request->description,
                       
              ));
              
         if($request->website_traffic == 'anyone_who_visits'){
             /*
              * do not apply rules, set only subtype as custom
              */
            
              $this->custom_audience->setData(array(
                       CustomAudienceFields::SUBTYPE => CustomAudienceSubtypes::CUSTOM,
                       
              ));           
             
         }else if($request->website_traffic == 'specific_pages'){
             /*
              * apply rules
              */
             $this->custom_audience->setData(array(
                       CustomAudienceFields::SUBTYPE => $request->sub_type,
                       CustomAudienceFields::RULE => Fb_AudienceUtilities::make_custom_audience_rule($request->url_key_words, $request->rule_definer),
                       CustomAudienceFields::RETENTION_DAYS => $request->retention_days,
                       CustomAudienceFields::PREFILL => $request->prefill,
                       # working
                       # https://developers.facebook.com/docs/marketing-api/custom-audience-website/v2.5
                       //CustomAudienceFields::RULE => '{"or": [{"url":{"i_contains":"shoes"}},{"url":{"i_contains":"boots"}}]}',
                     ));
         }
         
     }
     
     public function handleCreateCustomerListRequest($request)
     {
         $this->custom_audience = new CustomAudience(null, $this->add_account_id);
         $this->custom_audience->setData(array(
                        CustomAudienceFields::NAME => $request->name,
                        CustomAudienceFields::DESCRIPTION => '',
                        CustomAudienceFields::SUBTYPE => CustomAudienceSubtypes::CUSTOM,
                     ));
         
         $data = Fb_AudienceUtilities::format_customer_list($request->data);
         
         try {
           $this->custom_audience->create();
           
           //$this->custom_audience->addUsers($data, CustomAudienceTypes::EMAIL);
           $this->custom_audience->addUsers($data, $request->data_type);
           $this->custom_audience->read(array(CustomAudienceFields::APPROXIMATE_COUNT));
//            echo "Estimated Size:"
//              . $this->custom_audience->{CustomAudienceFields::APPROXIMATE_COUNT}."\n";
  
           return $this->custom_audience;
           //return $this->custom_audience->id;
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }
     }
     
     public function handleUpdateCustomerListRequest($request, $audience_custom){
        
        $this->custom_audience = new CustomAudience($audience_custom->audience_id, $this->add_account_id);
        
        $this->custom_audience->setData(array(
                        CustomAudienceFields::NAME => $request->name,
                        CustomAudienceFields::DESCRIPTION => $request->description,
                        //CustomAudienceFields::SUBTYPE => CustomAudienceSubtypes::CUSTOM,
                     ));
        
        try {
           $this->custom_audience->update();
           $this->addRemovePeople($request, $audience_custom);
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }
        
        
        return $this->custom_audience;
        
     }
     
     private function addRemovePeople($request, $audience_custom){
         if($audience_custom->data != ''){
            
            $data = Fb_AudienceUtilities::format_customer_list($request->data);
            
            #add people
            if($request->data_action_selector == 'add_to_list'){
                
                $this->custom_audience->addUsers($data, $request->data_type);
                
            }else if($request->data_action_selector == 'remove_from_list'){
            #remove people 
                
                $this->custom_audience->removeUsers($data, $request->data_type);
                
            }
        }
     }
     
     
     public function handleReadRequest(){
         
        try{
            $this->ad_account = new AdAccount($this->add_account_id);
            /*
             * full list of available fields parameters that can be fetched
             * https://developers.facebook.com/docs/marketing-api/reference/custom-audience#read
             */
            $this->custom_audience = $this->ad_account->getCustomAudiences(array('description','name','delivery_status'));
        }catch (RequestException $e) {
           $this->handleRequestException($e);
        }
        
         return $this->custom_audience;
     }
     
    
}
