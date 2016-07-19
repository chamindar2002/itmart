<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;

use Allison\Console\Commands\FbAd\FbAppInnitialize;

use FacebookAds\Object\Campaign;
use FacebookAds\Object\Values\InsightsLevels;
use FacebookAds\Object\Values\InsightsPresets;


class FetchFbInsightAnalyticsCommand extends Command
{
    use FbAppInnitialize;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:analytics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    private $access_token = null;
    private $ad_account_id = null;
    private $campaign_id = '6046421712292';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->access_token = 'CAAPgIZBacbTMBACAZAuRI4BbrZCJ8cZBQ5CZAYN551F42VivCNOMfqAUP5fesyLg1E5cO9fASJa15KZAaGJBug6NWcMwTdZASSSnhOPB9oTqMWXaHErOK0XIrlmqBRKGpmZBOZCabiQBn645fLu33J0ZCU38gFew3xG01wH7PCkGprgxhidnVmr0VQtZBWq9nyOf0QZD';
        $this->ad_account_id = 'act_1672901192958997';
        parent::__construct();
       // parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        #https://developers.facebook.com/docs/marketing-api/insights-api/getting-started/v2.5
        
        #http://stackoverflow.com/questions/31813573/facebook-ads-api
        
        $this->init($this->access_token);
        
//        $campaign = new Campaign($this->campaign_id);
//        
//        
//        $params = array(
//          'level' => InsightsLevels::CAMPAIGN,
//        );
//        
//        $async_job = $campaign->getInsightsAsync(array(), $params);
//
//        $async_job->read();
//
//        while (!$async_job->isComplete()) {
//          sleep(1);
//          $async_job->read();
//        }
//
//        $async_job->getResult();
//        
//        //dd($async_job);
//        exit();
        
        
        
        
        
        $campaign = new Campaign($this->campaign_id);
        $params = array(
          'date_preset' => InsightsPresets::LAST_7_DAYS,
        );
        
        $insights = $campaign->getInsights(array(), $params);
        //print_r($insights['data']);
        
        dd($insights);
        
        foreach($insights As $key=>$value){
            echo $value->cpm;
        }

    }
}
