<?php

namespace Allison\Repositories\Contracts;

interface IfFbAdcampaignsRepository
{
    public function getAllCampaigns();

    public function create($request, $ad_campaign_helper);

    public function getCampaign($id);

    public function update($request, $ad_campaign_helper, $id);

    public function destroy($ad_campaign_helper, $id);
}
