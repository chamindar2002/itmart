<?php
namespace Allison\Repositories\FbAudienceLookalike;

use Allison\Repositories\Contracts\IfFbAudienceLookalike;

use Allison\models\FbAudience\AudienceLookalike;

use Auth;
/**
 * Description of FbAudienceCustom
 *
 * @author Efutures
 */
class FbAudienceLookalike implements IfFbAudienceLookalike{
    
    
    public function getAllLookalikeAudiences()
    {
        if (Auth::user()->fbProfile) {
            
            return AudienceLookalike::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();
           
        }
    }

    public function create($request, $audience_lookalike_helper, $fb_audience_custom)
    {
         $lookalike_audience = $audience_lookalike_helper->handleCreateRequest($request, $fb_audience_custom);
         dd($lookalike_audience);
    }

    public function getLookalikeAudience($id)
    {
        
    }

    public function update($request, $audience_lookalike_helper, $id)
    {
        
    }

    public function destroy($audience_lookalike_helper, $id)
    {
        
    }

    public function listLookalikeAudiences($lookalike_audience)
    {
        
    }
    
}
