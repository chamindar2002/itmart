<?php

namespace Allison\Repositories\FbAdcampaign;

use Allison\Repositories\Contracts\IfFbAdcampaignsRepository;
use Allison\models\FbAd\AdCampaign;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdAccountAssigner;
use FacebookAds\Object\Fields\CampaignFields;
use Auth;
use Cache;

class FbAdcampaignsRepository implements IfFbAdcampaignsRepository
{
    public function getAllCampaigns($remember = true)
    {
        if (Auth::user()->fbProfile) {

            if($remember){

                $results = Cache::remember('campaign_listing_cache', Config('database.CACHE_TIMEOUT'), function(){
                    return AdCampaign::where('fb_profile_id', Auth::user()->fbProfile->id)->get();
                });

            }


            //return $results;
            return AdCampaign::where('fb_profile_id', Auth::user()->fbProfile->id)->get();
            //return Auth::user()->fbProfile->access_token;
        }
    }


    public function getCampaign($id)
    {
        return AdCampaign::find($id);
    }

    public function create($request, $ad_campaign_helper)
    {
        
        
        $campaign_id = $ad_campaign_helper->handleCreateRequest($request);
        
        //$ad_campaign_helper->getExceptions();
        //die($ad_campaign_helper->getExceptions());

        if ($ad_campaign_helper->getExceptions() == null) {
            $fb_ad_campaign = new AdCampaign();
            $fb_ad_campaign->campaign_id = $campaign_id;
            $fb_ad_campaign->name = $request->input('name');
            $fb_ad_campaign->fb_profile_id = Auth::user()->fbProfile->id;
            $fb_ad_campaign->ad_account = Fb_AdAccountAssigner::getAddAccountId();
            $fb_ad_campaign->objective = $request->input('objective');
            $fb_ad_campaign->status = $request->input('status');

            if ($fb_ad_campaign->save()) {
                return true;
            }
        }
       
        return $ad_campaign_helper;
    }

    public function update($request, $ad_campaign_helper, $id)
    {
        $fb_ad_campaign = AdCampaign::find($id);

        $result = $ad_campaign_helper->handleUpdateRequest($request, $fb_ad_campaign);

        if ($ad_campaign_helper->getExceptions() == null) {
            $fb_ad_campaign->name = $request->input('name');
            $fb_ad_campaign->objective = $request->input('objective');
            $fb_ad_campaign->status = $request->input('status');

            if ($fb_ad_campaign->save()) {
                return true;
            }
        }

        return $ad_campaign_helper;
    }

    public function destroy($ad_campaign_helper, $id)
    {
        $fb_ad_campaign = AdCampaign::find($id);

        $result = $ad_campaign_helper->handleDeleteRequest($fb_ad_campaign);
        
        if ($ad_campaign_helper->getExceptions() == null) {
            if ($fb_ad_campaign->delete()) {
                return true;
            }
        }

        return $ad_campaign_helper;
    }
    
    public function syncInsert($campaign, $profile, $ad_account){
        echo 'insert '.PHP_EOL;
        $model = new AdCampaign();
        $model->campaign_id = $campaign->{CampaignFields::ID};
        $model->name = $campaign->{CampaignFields::NAME};
        $model->fb_profile_id = $profile->id;
        $model->ad_account = $ad_account;
        $model->objective = $campaign->{CampaignFields::OBJECTIVE};
        $model->status = $campaign->{CampaignFields::CONFIGURED_STATUS}; #need to replace this. does not return the status attribute in the object
        if($model->save()){
            return $model->id;
        }
        
        
        return false;
      
    }
    
    public function syncUpdate($campaign){
        echo 'update'.PHP_EOL;
        $model = AdCampaign::where('campaign_id', $campaign->{CampaignFields::ID})->first();
        if($model != null){
            echo 'model != null'.PHP_EOL;
           //dd($this->isModified($model, $campaign));
            if($this->isModified($model, $campaign)){
                /*
                 * record is modified
                 */
                echo 'is modified'.PHP_EOL;
                $model->name = $campaign->{CampaignFields::NAME};
                $model->objective = $campaign->{CampaignFields::OBJECTIVE};
                $model->status = $campaign->{CampaignFields::CONFIGURED_STATUS};
                $model->save();
                return true;
            }
            /*
             * there is a record but not modified (so do not insert)
             */
            return true;
        }
         
        /*
         * no record in the table therefore insert new
         */
        return false;
    }
    
    public function isModified($local, $remote){
       
        if($local->name != $remote->{CampaignFields::NAME}){
             echo 'name modified'.PHP_EOL;
            return true;
        }else if($local->objective != $remote->{CampaignFields::OBJECTIVE}){
             echo 'objective modified'.PHP_EOL;
            return true;
        }else if($local->status != $remote->{CampaignFields::CONFIGURED_STATUS}){
            echo 'status modified'.PHP_EOL;
            return true;
        }
         echo 'nothing is modified'.PHP_EOL;
        return false;
    }
}
