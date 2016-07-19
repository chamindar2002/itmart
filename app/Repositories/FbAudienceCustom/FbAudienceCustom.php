<?php
namespace Allison\Repositories\FbAudienceCustom;

use Allison\Repositories\Contracts\IfFbAudienceCustom;

use Auth;

use Allison\models\FbAudience\AudienceCustom;

use Allison\AllisonFbApiHelpers\helpers\Fb_AudienceCustomHelper;

use Allison\AllisonFbApiHelpers\helpers\Fb_AudienceUtilities;

use FacebookAds\Object\Fields\CustomAudienceFields;

/**
 * Description of FbAudienceCustom
 *
 * @author Efutures
 */
class FbAudienceCustom implements IfFbAudienceCustom{
    
    
    
    public function getAllCustomAudiences()
    {
        if (Auth::user()->fbProfile) {
            
            return AudienceCustom::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();
           
        }
    }

    public function create($request, $audience_custom_helper)
    {
       $audience = $audience_custom_helper->handleCreateRequest($request);
              
       if ($audience_custom_helper->getExceptions() == null) {
           
           $audience_custom = new AudienceCustom();
           $audience_custom->name = $request->name;
           $audience_custom->description = isset($request->description)? $request->description : '';
           $audience_custom->audience_id = $audience->id;
           $audience_custom->pixel_id = $request->pixel_id;
           $audience_custom->fb_profile_id = Auth::user()->fbProfile->id;
           $audience_custom->ad_account_id = Auth::user()->fbAdAccount->id;
           $audience_custom->sub_type = $request->sub_type;
           $audience_custom->retention_days = $request->retention_days;
           $audience_custom->website_traffic = $request->website_traffic;
           $audience_custom->rule_definer = isset($request->rule_definer) ? $request->rule_definer : '';
           $audience_custom->url_key_words = isset($request->url_key_words) ? $request->url_key_words : '';
           $audience_custom->rule = ($audience->rule != null) ? $audience->rule : '';
           
           if ($audience_custom->save()) {
                return true;
           }
       
       }
       return false;
    }

    public function getCustomAudience($id)
    {
        return AudienceCustom::find($id);
    }

    public function update($request, $audience_custom_helper, $id)
    {
        $audience_custom = $this->getCustomAudience($id);
        
        $audience = $audience_custom_helper->handleUpdateRequest($request, $audience_custom);
                
        if ($audience_custom_helper->getExceptions() == null) {
            $audience_custom->name = $request->name;
            $audience_custom->description = isset($request->description)? $request->description : '';
            //$audience_custom->sub_type = $request->sub_type;
            $audience_custom->retention_days = $request->retention_days;
            $audience_custom->website_traffic = $request->website_traffic;
            $audience_custom->rule_definer = $request->rule_definer;
            $audience_custom->url_key_words = isset($request->url_key_words) ? $request->url_key_words : '';
            $audience_custom->rule = $audience->rule;
            
            if ($audience_custom->save()) {
                return true;
            }
        }
        
        return false;
    }

    public function destroy($audience_custom_helper, $id)
    {
        $audience_custom = $this->getCustomAudience($id);

        $result = $audience_custom_helper->handleDeleteRequest($audience_custom);

        if ($audience_custom_helper->getExceptions() == null) {
            if ($audience_custom->delete()) {
                return true;
            }
        }

        return false;
    }

    public function listCustomAudiences()
    {
        $custom_audiences = array();
        
        foreach($this->getAllCustomAudiences() as $ca){
            $custom_audiences[$ca->id] = $ca->name;
        }
        
        return $custom_audiences;
    }
    
    public function create_customer_list($request, $audience_custom_helper)
    {
       $audience = $audience_custom_helper->handleCreateCustomerListRequest($request);
              
       if ($audience_custom_helper->getExceptions() == null) {
           
           $data = Fb_AudienceUtilities::format_customer_list($request->data);
           
           $audience_custom = new AudienceCustom();
           $audience_custom->name = $request->name;
           $audience_custom->description = isset($request->description)? $request->description : '';
           $audience_custom->audience_id = $audience->id;
           $audience_custom->pixel_id = $request->pixel_id;
           $audience_custom->fb_profile_id = Auth::user()->fbProfile->id;
           $audience_custom->ad_account_id = Auth::user()->fbAdAccount->id;
           $audience_custom->sub_type = isset($request->sub_type) ? $request->sub_type: 'CUSTOM';
           $audience_custom->retention_days = isset($request->retention_days) ? $request->retention_days: 0;
           $audience_custom->website_traffic = isset($request->website_traffic) ? $request->website_traffic: '';
           $audience_custom->rule_definer = isset($request->rule_definer) ? $request->rule_definer : '';
           $audience_custom->url_key_words = isset($request->url_key_words) ? $request->url_key_words : '';
           $audience_custom->rule = ($audience->rule != null) ? $audience->rule : '';
           $audience_custom->data_type = $request->data_type;
           $audience_custom->data = json_encode($data);
           $audience_custom->audience_size = $audience->{CustomAudienceFields::APPROXIMATE_COUNT};
           
           if ($audience_custom->save()) {
                return true;
           }
       
       }
       return false;
    }
    
    public function update_customer_list($request, $audience_custom_helper, $id){
        
        $audience_custom = $this->getCustomAudience($id);
        
        $audience = $audience_custom_helper->handleUpdateCustomerListRequest($request, $audience_custom);
                
        if ($audience_custom_helper->getExceptions() == null) {
            $audience_custom->name = $request->name;
            $audience_custom->description = isset($request->description)? $request->description : '';
            //$audience_custom->sub_type = $request->sub_type;
            $audience_custom->retention_days =isset($request->retention_days) ? $request->retention_days: 0;;
            $audience_custom->website_traffic = isset($request->website_traffic) ? $request->website_traffic: '';
            $audience_custom->rule_definer = isset($request->rule_definer) ? $request->rule_definer : '';
            $audience_custom->url_key_words = isset($request->url_key_words) ? $request->url_key_words : '';
            $audience_custom->rule = ($audience->rule != null) ? $audience->rule : '';
            $audience_custom->data_type = $request->data_type;
            //$audience_custom->data = json_encode($data);#not important as user will never get to see the emails, phone numbers tied to an audience
            $audience_custom->audience_size = $audience->{CustomAudienceFields::APPROXIMATE_COUNT};
            
            if ($audience_custom->save()) {
                return true;
            }
        }
        
        return false;
        
    }
    
    public function syncAudienceCustom($audience_custom_helper){
        $response = $audience_custom_helper->handleReadRequest();
        
        if ($audience_custom_helper->getExceptions() == null) {             
            
            foreach($response As $rs){
                $data = $rs->getData();
                //echo '<pre>';
                //print_r($rs->getData());
                //var_dump($data);
                //exit;
                $custom_audience = $this->getCustomAudienceByAudienceId($data['id']);
                if($custom_audience){
                    $custom_audience->name = $data['name'];
                    $custom_audience->description = $data['description'];
                    $custom_audience->delivery_status_code = $data['delivery_status']['code'];
                    $custom_audience->delivery_status_description = $data['delivery_status']['description'];
                    $custom_audience->save();
                }
                //echo '</pre>';
            }
        
        }
        
    }
    
    private function getCustomAudienceByAudienceId($audience_id){
        
        return AudienceCustom::where('audience_id', $audience_id)->first();
        
    }
    
}
