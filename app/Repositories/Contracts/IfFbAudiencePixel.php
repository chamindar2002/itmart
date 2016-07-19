<?php
namespace Allison\Repositories\Contracts;

/**
 *
 * @author Efutures
 */
interface IfFbAudiencePixel {
    
    
    public function getAdAccountPixel();

    public function create($request, $audience_pixel_helper);

    public function getPixel($id);

    public function update($request, $audience_pixel_helper, $id);

    public function destroy($ad_adpublish_helper, $id);
    
    public function syncAudiencePixel($audience_pixel_helper);
    
    public function getPixelByAdAccountId($ad_account_id);
    
    public function syncAudiencePixelCode($audience_pixel_helper, $audience_pixel);
    
    public function listAudiencePixel();
}
