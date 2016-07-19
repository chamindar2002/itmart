<?php

namespace Allison\AllisonFbApiHelpers\helpers;

use Allison\AllisonFbApiHelpers\contracts\FbContract;
use FacebookAds\Object\TargetingSearch;
use FacebookAds\Object\Search\TargetingSearchTypes;
use FacebookAds\Object\TargetingSpecs;
use FacebookAds\Object\Fields\TargetingSpecsFields;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Values\OptimizationGoals;
use FacebookAds\Object\Values\BillingEvents;
use FacebookAds\Http\Exception\RequestException;
use DateTime;
use FacebookAds\Object\AdAccount;
use Allison\models\FbAd\AdTargetGroup;

class Fb_AdSetHelper extends FbContract
{
    private $adset;
    
    private $ad_account;
    
    private $arr_target_groups = array();

    public function init()
    {
        $this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
    }

    public function fetchTargets($search_text, $limit)
    {

       #currently only search for INTEREST others (e.g:EDUCATION,EMPLOYER, etc) to be implemented later
       #https://developers.facebook.com/docs/marketing-api/targeting-search/v2.5
     
       try {
           $results = TargetingSearch::search(TargetingSearchTypes::INTEREST, null, $search_text, array('limit'=>$limit));
           
//           $results = TargetingSearch::search(
//           $type = TargetingSearchTypes::INTEREST,
//           $class = null,
//           $query = 'facebook');
           
//          $results = TargetingSearch::search(TargetingSearchTypes::GEOLOCATION, null, $search_text,array(
//            'location_types' => array('country'),
//          ));
          
       } catch (Exception $e) {
           dd($e);
       }

        if ($results) {
            return $results->getObjects();
        }

        return array();
    }

    public function handleCreateRequest($request, $ad_campaign)
    {
        $targeting = new TargetingSpecs();
        
        #compose targetting group array
        $target_groups = json_decode($request->selected_target_groups);
        if(count($target_groups) > 0){
            
            foreach($target_groups As $key=>$value){
                
                $data = AdTargetGroup::where('group_id',$value)->first();
               
                if(count($data) > 0){
                    $this->arr_target_groups[] = array(
                        'id' => $data->group_id,
                        'name' => $data->name);
                }
            }
            
        }
        #end composing targeting group array.
        
        $targeting->{TargetingSpecsFields::GEO_LOCATIONS}
                        = array('countries' => $request->geo_location);

        /*$targeting->{TargetingSpecsFields::INTERESTS} = array(
            array(
                'id' => $request->target_id,
                'name' => $request->selected_target_name,
            ),
        );*/
        
        $targeting->{TargetingSpecsFields::INTERESTS} = $this->arr_target_groups;

        $start_time = new DateTime(date('Y-m-d H:i:s', strtotime($request->start_time)));

        $end_time = new DateTime(date('Y-m-d H:i:s', strtotime($request->end_time)));

        $status = $request->status != '' ? Fb_AdUtilities::popStatus($request->status) : 'PAUSED';

        $this->adset = new AdSet(null, $this->add_account_id);

        $this->adset->setData(array(
          AdSetFields::NAME => $request->name,
          //AdSetFields::OPTIMIZATION_GOAL => OptimizationGoals::REACH, #need to make this selectable later
          AdSetFields::OPTIMIZATION_GOAL => $request->optimization_goals,
          AdSetFields::BILLING_EVENT => BillingEvents::IMPRESSIONS, #need to make this selectable later
          AdSetFields::BID_AMOUNT => $request->bid_amount,
          AdSetFields::DAILY_BUDGET => $request->daily_budget,
          AdSetFields::CAMPAIGN_ID => $ad_campaign->getCampaign($request->campaign_id)->campaign_id,
          AdSetFields::TARGETING => $targeting,
          AdSetFields::START_TIME => $start_time->format(DateTime::ISO8601),
          AdSetFields::END_TIME => $end_time->format(DateTime::ISO8601),
        ));
        
       
        
       //dd($request->optimization_goals);
       
       //dd($this->adset);

       try {
           $this->adset->create(array(
                AdSet::STATUS_PARAM_NAME => $status,
              ));

           return $this->adset->id;
       } catch (RequestException $e) {
           $this->handleRequestException($e);
       }
    }

    public function handleUpdateRequest($request, $fb_ad_set)
    {
        $start_time = new DateTime(date('Y-m-d H:i:s', strtotime($request->start_time)));

        $end_time = new DateTime(date('Y-m-d H:i:s', strtotime($request->end_time)));

        $targeting = new TargetingSpecs();
        
        #compose targetting group array
        $target_groups = json_decode($request->selected_target_groups);
        if(count($target_groups) > 0){
            
            foreach($target_groups As $key=>$value){
                
                $data = AdTargetGroup::where('group_id',$value)->first();
               
                if(count($data) > 0){
                    $this->arr_target_groups[] = array(
                        'id' => $data->group_id,
                        'name' => $data->name);
                }
            }
            
        }
        #end composing targeting group array.
        
        $targeting->{TargetingSpecsFields::GEO_LOCATIONS}
                        = array('countries' => $request->geo_location);

        /*if ($request->target_id != '' && $request->selected_target_name != '') {
            $targeting->{TargetingSpecsFields::INTERESTS} = array(
                        array(
                            'id' => $request->target_id,
                            'name' => $request->selected_target_name,
                        ),
                   );
        } else {
            $targeting->{TargetingSpecsFields::INTERESTS} = array(
                     array(
                         'id' => $fb_ad_set->target_id,
                         'name' => $fb_ad_set->target_name,
                     ),
                );
        }*/
                        
        $targeting->{TargetingSpecsFields::INTERESTS} = $this->arr_target_groups;

        $status = $request->status != '' ? Fb_AdUtilities::popStatus($request->status) : 'PAUSED';

        $this->adset = new AdSet($fb_ad_set->ad_set_id);

        $this->adset->setData(array(
            AdSetFields::NAME => $request->name,
            //AdSetFields::OPTIMIZATION_GOAL => OptimizationGoals::REACH, #need to make this selectable later
            AdSetFields::OPTIMIZATION_GOAL => $request->optimization_goals,
            AdSetFields::BILLING_EVENT => BillingEvents::IMPRESSIONS, #need to make this selectable later
            AdSetFields::BID_AMOUNT => $request->bid_amount,
            AdSetFields::DAILY_BUDGET => $request->daily_budget,
            AdSetFields::CAMPAIGN_ID => $fb_ad_set->adCampaign->campaign_id,
            AdSetFields::TARGETING => $targeting,
            AdSetFields::START_TIME => $start_time->format(DateTime::ISO8601),
            AdSetFields::END_TIME => $end_time->format(DateTime::ISO8601),

          ));
        
        //dd($this->adset);
        
        try{
            
            $this->adset->update(
                        array(
                      AdSet::STATUS_PARAM_NAME => $status,
                    )
                  );
            
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        

        return $this->adset;
    }
    
    public function handleDeleteRequest($fb_ad_set)
    {
        $this->adset = new AdSet($fb_ad_set->ad_set_id);
        
        try {
            
            $this->adset->update(
                        array(
                      AdSet::STATUS_PARAM_NAME => Fb_AdUtilities::popStatus('DELETED'),
                    )
                  );
            
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
        
        return $this->adset;
    }
    
    public function handleReadRequest(){
        try{
            $this->ad_account = new AdAccount($this->add_account_id);
            $this->adset =  $this->ad_account->getAdSets(array(
                            AdSetFields::BID_AMOUNT,
                            AdSetFields::ID,
                            AdSetFields::NAME,
                            AdSetFields::CAMPAIGN_ID,
                            AdSetFields::CONFIGURED_STATUS,
                            AdSetFields::START_TIME,
                            AdSetFields::TARGETING,
                            AdSetFields::ACCOUNT_ID,
                            AdSetFields::END_TIME,
                            AdSetFields::DAILY_BUDGET,                            
                        ));
        
            
            /*foreach($this->adset As $as){
                    echo $as->{AdSetFields::NAME}.PHP_EOL;
                    echo $as->{AdSetFields::ID}.PHP_EOL;
                    echo $as->{AdSetFields::BID_AMOUNT}.PHP_EOL;
                    echo $as->{AdSetFields::CAMPAIGN_ID}.PHP_EOL;
                    echo $as->{AdSetFields::CONFIGURED_STATUS}.PHP_EOL;
                    echo $as->{AdSetFields::START_TIME}.PHP_EOL;
                    echo date('Y-m-d', strtotime($as->{AdSetFields::START_TIME})).PHP_EOL;
                    echo serialize($as->{AdSetFields::TARGETING}).PHP_EOL;
                    echo '----------------------------------------------------'.PHP_EOL;

            }*/
           
        }catch (RequestException $e) {
           $this->handleRequestException($e);
        }
        
        
        return $this->adset;
    }
}
