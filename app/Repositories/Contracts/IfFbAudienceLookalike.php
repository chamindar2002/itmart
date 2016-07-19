<?php
namespace Allison\Repositories\Contracts;

/**
 *
 * @author Efutures
 */
interface IfFbAudienceLookalike {
    
    public function getAllLookalikeAudiences();

    public function create($request, $audience_lookalike_helper, $fb_audience_custom);

    public function getLookalikeAudience($id);

    public function update($request, $audience_lookalike_helper, $id);

    public function destroy($audience_lookalike_helper, $id);

    public function listLookalikeAudiences($lookalike_audience);
    
}
