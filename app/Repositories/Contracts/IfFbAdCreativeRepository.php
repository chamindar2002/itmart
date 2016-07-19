<?php
namespace Allison\Repositories\Contracts;

/**
 *
 * @author Efutures
 */
interface IfFbAdCreativeRepository {
    
    public function getAllAdCreatives();

    public function create($request, $ad_adcreative_helper);

    public function getAdCreative($id);

    public function update($request, $ad_adcreative_helper, $id);

    public function destroy($ad_adcreative_helper, $id);
    
    public function listMedia($adcreative);
    
    public function listAdCreatives();

}
