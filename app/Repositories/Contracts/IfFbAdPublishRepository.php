<?php
namespace Allison\Repositories\Contracts;

/**
 *
 * @author Efutures
 */
interface IfFbAdPublishRepository {
    
    public function getAllAds();

    public function create($request, $ad_adpublish_helper, $fb_adset, $fb_adcreative);

    public function getAd($id);

    public function update($request, $ad_adpublish_helper, $id);

    public function destroy($ad_adpublish_helper, $id);
    
        
}
