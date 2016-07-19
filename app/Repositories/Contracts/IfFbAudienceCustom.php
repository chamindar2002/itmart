<?php
namespace Allison\Repositories\Contracts;

/**
 *
 * @author Efutures
 */
interface IfFbAudienceCustom {
    
    public function getAllCustomAudiences();

    public function create($request, $audience_custom_helper);

    public function getCustomAudience($id);

    public function update($request, $audience_custom_helper, $id);

    public function destroy($audience_custom_helper, $id);

    public function listCustomAudiences();
    
}
