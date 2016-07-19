<?php

namespace Allison\AllisonFbApiHelpers\helpers;

use Allison\AllisonFbApiHelpers\contracts\FbContract;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Values\AdObjectives;
use FacebookAds\Http\Exception\RequestException;

/**
 * Description of Fb_AdCampaignHelper.
 *
 * @author Oracle
 */
class Fb_AdCampaignHelper extends FbContract
{
    public function init()
    {
        $this->add_account_id = Fb_AdAccountAssigner::getAddAccountId();
    }

    public function handleCreateRequest($request)
    {
        $campaign = new Campaign(null, $this->add_account_id);

        $campaign->setData(array(
          CampaignFields::NAME => $request->input('name'),
          //CampaignFields::OBJECTIVE => AdObjectives::LINK_CLICKS,
          CampaignFields::OBJECTIVE => $this->popObjective($request->objective),
        ));

        try {
            $campaign->create(array(
          //Campaign::STATUS_PARAM_NAME => Campaign::STATUS_PAUSED,
            Campaign::STATUS_PARAM_NAME => Fb_AdUtilities::popStatus($request->status),
        ));

        //echo "Campaign ID:" . $campaign->id . "\n";
        return $campaign->id;
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
    }

    public function handleUpdateRequest($request, $campaign)
    {
        $campaign = new Campaign($campaign->campaign_id);
        $campaign->{CampaignFields::NAME} = $request->name;
        $campaign->{CampaignFields::OBJECTIVE} = $this->popObjective($request->objective);

        try {
            $campaign->update(array(
                                Campaign::STATUS_PARAM_NAME => Fb_AdUtilities::popStatus($request->status),
                              )

                    );
        } catch (RequestException $e) {
            $this->handleRequestException($e);
        }
    }

    public function handleDeleteRequest($campaign)
    {
        $campaign = new Campaign($campaign->campaign_id);

        try {
            $campaign->update(array(
                                Campaign::STATUS_PARAM_NAME =>'DELETED',
                              )

                    );
            
           
        } catch (RequestException $e) {
            $this->handleRequestException($e);
            
        }
        
    }

    public function popObjective($objective)
    {
        switch ($objective) {
            case 'CANVAS_APP_ENGAGEMENT':
                return AdObjectives::CANVAS_APP_ENGAGEMENT;
                break;
            case 'CANVAS_APP_INSTALLS':
                return AdObjectives::CANVAS_APP_INSTALLS;
                break;
            case 'EVENT_RESPONSES':
                return AdObjectives::EVENT_RESPONSES;
                break;
            case 'LOCAL_AWARENESS':
                return AdObjectives::LOCAL_AWARENESS;
                break;
            case 'MOBILE_APP_ENGAGEMENT':
                return AdObjectives::MOBILE_APP_ENGAGEMENT;
                break;
            case 'MOBILE_APP_INSTALLS':
                return AdObjectives::MOBILE_APP_INSTALLS;
                break;
            case 'NONE':
                return AdObjectives::NONE;
                break;
            case 'OFFER_CLAIMS':
                return AdObjectives::OFFER_CLAIMS;
                break;
            case 'PAGE_LIKES':
                return AdObjectives::PAGE_LIKES;
                break;
            case 'POST_ENGAGEMENT':
                return AdObjectives::POST_ENGAGEMENT;
                break;
            case 'PRODUCT_CATALOG_SALES':
                return AdObjectives::PRODUCT_CATALOG_SALES;
                break;
            case 'LINK_CLICKS':
                return AdObjectives::LINK_CLICKS;
                break;
            case 'CONVERSIONS':
                return AdObjectives::CONVERSIONS;
                break;
            case 'VIDEO_VIEWS':
                return AdObjectives::VIDEO_VIEWS;
                break;

        }
    }
}
