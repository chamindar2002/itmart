<?php
namespace Allison\AllisonFbApiHelpers\helpers;

use Allison\AllisonFbApiHelpers\contracts\FbContract;
use FacebookAds\Object\CustomAudience;
use FacebookAds\Object\Fields\CustomAudienceFields;
use FacebookAds\Object\Values\CustomAudienceSubtypes;
use FacebookAds\Http\Exception\EmptyResponseException;


/**
 * Description of Fb_AudienceLookalikeHelper
 *
 * @author Efutures
 */
class Fb_AudienceLookalikeHelper extends FbContract{
    
    private $lookalike_audience; 
    
    public function init()
    {
        $this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
    }
    
    public function handleCreateRequest($request, $fb_audience_custom){
         
       $this->lookalike_audience = new CustomAudience(null, $this->add_account_id);
         
         //$this->lookalike_audience = new CustomAudience(null, $this->add_account_id);
         //return $request->custom_audience_id;
         $custom_audience = $fb_audience_custom->getCustomAudience($request->custom_audience_id);
         //return $custom_audience->audience_id;
         
         $this->lookalike_audience->setData(array(
            CustomAudienceFields::NAME => $request->name,
            CustomAudienceFields::SUBTYPE => CustomAudienceSubtypes::LOOKALIKE,
            CustomAudienceFields::ORIGIN_AUDIENCE_ID => $custom_audience->audience_id,
            CustomAudienceFields::LOOKALIKE_SPEC => array(
              'type' => 'similarity',
              'country' => $request->country_code,
            ),
          ));
         
         
        try {
           $this->lookalike_audience->create();
           
           $this->lookalike_audience->read(array(CustomAudienceFields::APPROXIMATE_COUNT));
           
           return array(
               'lookalike_audience' => $this->lookalike_audience->id,
               'estimated_size' => $this->lookalike_audience->{CustomAudienceFields::APPROXIMATE_COUNT}
           );
           
        } catch (RequestException $e) {
           $this->handleRequestException($e);
        }catch (EmptyResponseException $e) {
           $this->handleRequestException($e);
        }
        
        return $this->lookalike_audience;
     }
    
}
