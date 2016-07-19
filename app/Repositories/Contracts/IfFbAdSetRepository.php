<?php

namespace Allison\Repositories\Contracts;

interface IfFbAdSetRepository
{
    public function getAllAdSets();

    public function create($request, $ad_addset_helper, $ad_campaign);

    public function getAdSet($id);

    public function update($request, $ad_addset_helper, $id);

    public function destroy($ad_addset_helper, $id);

    public function listCampaigns($campaigns);

    public function cacheTargets($fb_adset_helper, $search_text, $adset);

    public function listCountries();
}
