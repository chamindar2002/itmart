<?php

namespace Allison\Repositories\FbAdcampaign;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Allison\models\Country;
use Allison\models\FbAd\AdSet;
use Allison\models\FbAd\AdCampaign;
use Allison\models\FbAd\AdTargetSearchCache;
use Allison\Repositories\Contracts\IfFbAdSetRepository;
use Auth;
use FacebookAds\Object\Fields\AdSetFields;
use Allison\models\FbAd\AdTargetGroup;
use Session;
use Cache;

class FbAdSetRepository implements IfFbAdSetRepository
{
    public function getAllAdSets($remember = true)
    {
        if (Auth::user()->fbProfile) {

            if($remember) {

                $results = Cache::remember('adset_listing_cache', Config('database.CACHE_TIMEOUT'), function () {
                    return AdSet::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();
                });
            }else{

            }

            return AdSet::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();

           //return Auth::user()->fbProfile->access_token;
        }
    }

    public function create($request, $ad_adset_helper, $ad_campaign)
    {
        $adset_id = $ad_adset_helper->handleCreateRequest($request, $ad_campaign);
        
        $status = $request->status != '' ? Fb_AdUtilities::popStatus($request->status) : 'PAUSED';

        if ($ad_adset_helper->getExceptions() == null) {
            $status = $request->status != '' ? Fb_AdUtilities::popStatus($request->status) : Fb_AdUtilities::popStatus('STATUS_PAUSED');

            $adset = new AdSet();
            $adset->campaign_id = $request->campaign_id;
            $adset->fb_profile_id = Auth::user()->fbProfile->id;
            $adset->name = $request->name;
            $adset->ad_set_id = $adset_id;
            //$adset->target_id = $request->target_id;
            $adset->target_id = 0;
            $adset->target_name = $request->selected_target_name;
            $adset->target_groups = $request->selected_target_groups;
            $adset->geo_locations = Fb_AdUtilities::serialize_data($request->geo_location);
            $adset->custom_audience_id = 0; #implement this when custom audience comes into play later
            $adset->custom_audience_name = ''; #implement this when custom audience comes into play later
            //$adset->optimization_goals = 'REACH'; #implement this later to be selectable later
            $adset->optimization_goals = $request->optimization_goals;
            $adset->bid_amount = $request->bid_amount;
            $adset->daily_budget = $request->daily_budget;
            $adset->start_time = date('Y-m-d', strtotime($request->start_time));
            $adset->end_time = date('Y-m-d', strtotime($request->end_time));
            $adset->status = $status;
            $adset->ad_account = $ad_adset_helper->getAdAccountId();

            if ($adset->save()) {
                
                #flush session variable stored with selected groups
                Session::forget('selected_target_groups');
                //Session::flush();
        
                return true;
            }
        }

        return $ad_adset_helper;
    }

    public function getAdSet($id)
    {
        return AdSet::find($id);
    }

    public function update($request, $ad_adset_helper, $id)
    {
        $adset = AdSet::find($id);

        $result = $ad_adset_helper->handleUpdateRequest($request, $adset);
        
        $status = $request->status != '' ? Fb_AdUtilities::popStatus($request->status) : 'PAUSED';

        if ($ad_adset_helper->getExceptions() == null) {
            $adset->campaign_id = $request->campaign_id;
            $adset->fb_profile_id = Auth::user()->fbProfile->id;
            $adset->name = $request->name;
            //$adset->target_id = $request->target_id;
            $adset->target_name = $request->selected_target_name;
            $adset->target_groups = $request->selected_target_groups;
            $adset->geo_locations = Fb_AdUtilities::serialize_data($request->geo_location);
            $adset->custom_audience_id = 0; #implement this when custom audience comes into play later
            $adset->custom_audience_name = ''; #implement this when custom audience comes into play later
            $adset->optimization_goals = 'REACH'; #implement this later to be selectable 
            $adset->bid_amount = $request->bid_amount;
            $adset->daily_budget = $request->daily_budget;
            $adset->start_time = date('Y-m-d', strtotime($request->start_time));
            $adset->end_time = date('Y-m-d', strtotime($request->end_time));
            $adset->status = $status;
            $adset->ad_account = $ad_adset_helper->getAdAccountId();

            if ($adset->save()) {
                return true;
            }
        }

        return $ad_adset_helper;
    }

    public function destroy($ad_adset_helper, $id)
    {
        $fb_ad_set = AdSet::find($id);

        $result = $ad_adset_helper->handleDeleteRequest($fb_ad_set);

        if ($ad_adset_helper->getExceptions() == null) {
            if ($fb_ad_set->delete()) {
                return true;
            }
        }

        return $ad_adset_helper;
    }

    public function listCampaigns($campaigns)
    {
        if ($campaigns) {
            $campaings_list = array();

            foreach ($campaigns as $campaign) {
                $campaings_list[$campaign->id] = $campaign->name;
            }

            return $campaings_list;
        }

        return array();
    }

    public function cacheTargets($fb_adset_helper, $search_text, $adset, $limit=8)
    {
        $results = AdTargetSearchCache::where('user_id', Auth::user()->id)
                                      ->where('search_text', $search_text)
                                      ->where('search_limit', $limit)
                                      ->first();

        if (!$results) {
            $response = $fb_adset_helper->fetchTargets($search_text, $limit);
            $ad_target_search = new AdTargetSearchCache();
            $ad_target_search->user_id = Auth::user()->id;
            $ad_target_search->search_text = $search_text;
            $ad_target_search->search_limit = $limit;
            $ad_target_search->search_results = Fb_AdUtilities::serialize_data($fb_adset_helper->fetchTargets($search_text, $limit));
            $cache_id = $ad_target_search->save();
            
            if(count($response) > 0){
                               
                foreach($response As $rs){
                     $data = $rs->getData();
                     $ad_target_groups = new AdTargetGroup();
                     $ad_target_groups->group_id = $data['id'];
                     $ad_target_groups->name = $data['name'];
                     $ad_target_groups->search_cache_id = $cache_id;
                     $ad_target_groups->save();
                 }
            }
            
            

            return $fb_adset_helper->fetchTargets($search_text, $limit);
        }

        return Fb_AdUtilities::unserialize_data($results->search_results);

//        }else{
//           
//            $ad_target_search = AdTargetSearchCache::find($results->id);
//            $ad_target_search->search_text = $search_text;
//            $ad_target_search->touch();#force update updated_at timestamp
//            //dd($ad_target_search);
//        }

        //exit();
    }

    public function listCountries()
    {
        return Country::all()->lists('name', 'code');
    }
    
    public function listAdSets(){
        
        $ad_sets = array();
        foreach($this->getAllAdSets() As $as){
            $ad_sets[$as->id] = $as->name;
        }
        
        return $ad_sets;
    }
    
    public function syncFbAdSet($adset_helper){
        $response = $adset_helper->handleReadRequest();

        if($response != null){

            foreach($response As $as) {

                $ad_set_existing = AdSet::where('ad_set_id', $as->{AdSetFields::ID})->first();

                $campaign = AdCampaign::where('campaign_id', $as->{AdSetFields::CAMPAIGN_ID})->first();

                if ($campaign == null) #temporary code to avoid exceptions if $campaign object is null
                    continue;


                if ($ad_set_existing) {
                    #update if modified

                    $adset = AdSet::find($ad_set_existing->id);
                    $targetting = $as->{AdSetFields::TARGETING};

                    $adset->campaign_id = $campaign->id;
                    $adset->fb_profile_id = Auth::user()->fbProfile->id;
                    $adset->name = $as->{AdSetFields::NAME};

                    if (array_key_exists('interests', $targetting)) {

                        $adset->target_id = $targetting['interests'][0]['id'];
                        $adset->target_name = $targetting['interests'][0]['name'];

                    }
                    $adset->geo_locations = Fb_AdUtilities::serialize_data($targetting['geo_locations']['countries']);
                    $adset->bid_amount = number_format($as->{AdSetFields::BID_AMOUNT}, 2);
                    $adset->daily_budget = number_format($as->{AdSetFields::DAILY_BUDGET}, 2);
                    $adset->start_time = date('Y-m-d H:i:s', strtotime($as->{AdSetFields::START_TIME}));
                    $adset->end_time = date('Y-m-d H:i:s', strtotime($as->{AdSetFields::END_TIME}));
                    $adset->status = $as->{AdSetFields::CONFIGURED_STATUS};


                    #compare the original with the updated one 
                    $result = array_diff($adset['original'], $adset['attributes']);

                    #update only if there is a change in the record fetched from api
                    if (sizeof($result) > 0) {

                        if ($adset->save()) {

                            //return true;

                        }


                    }


                } else {
                    #add new record
                    $adset = new AdSet();
                    $targetting = $as->{AdSetFields::TARGETING};

                    $adset->campaign_id = $campaign->id;
                    $adset->fb_profile_id = Auth::user()->fbProfile->id;
                    $adset->name = $as->{AdSetFields::NAME};
                    $adset->ad_set_id = $as->{AdSetFields::ID};

                    if (array_key_exists('interests', $targetting)) {

                        $adset->target_id = $targetting['interests'][0]['id'];
                        $adset->target_name = $targetting['interests'][0]['name'];

                    }
                    $adset->geo_locations = Fb_AdUtilities::serialize_data($targetting['geo_locations']['countries']);
                    $adset->bid_amount = number_format($as->{AdSetFields::BID_AMOUNT}, 2);
                    $adset->daily_budget = number_format($as->{AdSetFields::DAILY_BUDGET}, 2);
                    $adset->start_time = date('Y-m-d H:i:s', strtotime($as->{AdSetFields::START_TIME}));
                    $adset->end_time = date('Y-m-d H:i:s', strtotime($as->{AdSetFields::END_TIME}));
                    $adset->status = $as->{AdSetFields::CONFIGURED_STATUS};
                    $adset->optimization_goals = 'REACH';

                    if ($adset->save()) {

                        //return true;

                    }

                }

            }


            }
            
            //exit;
    }
}
