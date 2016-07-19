<?php
namespace Allison\Repositories\FbAd;

use Allison\Repositories\Contracts\IfFbAdPublishRepository;

use Allison\models\FbAd\AdPublish;

use Auth;

use Cache;

class FbAdPublishRepository implements IfFbAdPublishRepository{
    
    
    public function getAllAds()
    {
        if (Auth::user()->fbProfile) {

            $results = Cache::remember('adpublish_listing_cache', Config('database.CACHE_TIMEOUT'), function(){
                return AdPublish::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();
            });

            return $results;

        }
    }

    public function create($request, $ad_adpublish_helper, $fb_adset, $fb_adcreative)
    {
        
        $ad_id = $ad_adpublish_helper->handleCreateRequest($request, $fb_adset, $fb_adcreative);

        if ($ad_adpublish_helper->getExceptions() == null) {
            
            $ad = new AdPublish();
            $ad->fb_profile_id = Auth::user()->fbProfile->id;
            $ad->ad_account = $ad_adpublish_helper->getAdAccountId();
            $ad->ad_id = $ad_id;
            $ad->name = $request->name;
            $ad->ad_creative_id = $request->ad_creative_id;
            $ad->ad_set_id = $request->ad_set_id;
            $ad->status = $request->status;
            
            if ($ad->save()) {
                return true;
            }
        }
        
        return $ad_adpublish_helper;
    }

    public function getAd($id)
    {
         return AdPublish::find($id);
    }

    public function update($request, $ad_adpublish_helper, $id)
    {
        $ad = $this->getAd($id);
        
        $ad_adpublish_helper->handleUpdateRequest($ad, $request);
        
        if ($ad_adpublish_helper->getExceptions() == null) {
            //$ad->fb_profile_id = Auth::user()->fbProfile->id;
            //$ad->ad_account = $ad_adpublish_helper->getAdAccountId();
            //$ad->ad_id = $ad_id;
            $ad->name = $request->name;
            $ad->ad_creative_id = $request->ad_creative_id;
            $ad->ad_set_id = $request->ad_set_id;
            $ad->status = $request->status;
            
            if ($ad->save()) {
                return true;
            }
        }

        return $ad_adpublish_helper;
    }

    public function destroy($ad_adpublish_helper, $id)
    {
        $ad = $this->getAd($id);
        
        $ad_adpublish_helper->handleDeleteRequest($ad);
        
        if ($ad_adpublish_helper->getExceptions() == null) {

            $ad->delete();
            
            return true;
            
        }

        return $ad_adpublish_helper;
    }
    
}
