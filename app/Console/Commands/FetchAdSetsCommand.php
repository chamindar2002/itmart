<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;

use Allison\Console\Commands\FbAd\FbAppInnitialize;

use Auth;

use FacebookAds\Object\AdAccount;

use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\AdSetFields;

class FetchAdSetsCommand extends Command
{
    use FbAppInnitialize;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:adset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    private $access_token = null;
    private $ad_account_id = null;
    private $ad_set = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->access_token = 'CAAPgIZBacbTMBANydczgnJnSSODAebiIPnQdE4eAWURAw8gDD6xNv07pqCnorZBq9YxO92T1FrJ2bUMCWlRVLiCHXSQiTHWVKCzu9HYsn2R3ZA4iZAlkfs4hVWN74wfJQ44tduZBvlIRdJCpdSkKyVnA9TILTduvbV4E8jovRHkRWy34oAwQZBwjSS8iCqlFBdFAiJ1OZCMBwZDZD';
        $this->ad_account_id = 'act_1637309866543107';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->init($this->access_token);
        $ad_account = new AdAccount($this->ad_account_id);
        
        $this->ad_set = $ad_account->getAdSets(array(
                            AdSetFields::BID_AMOUNT,
                            AdSetFields::ID,
                            AdSetFields::NAME,
                            AdSetFields::CAMPAIGN_ID,
                            AdSetFields::CONFIGURED_STATUS,
                            AdSetFields::START_TIME,
                            AdSetFields::TARGETING,
                        ));
        
        foreach($this->ad_set As $as){
                echo $as->{AdSetFields::NAME}.PHP_EOL;
                echo $as->{AdSetFields::ID}.PHP_EOL;
                echo $as->{AdSetFields::BID_AMOUNT}.PHP_EOL;
                echo $as->{AdSetFields::CAMPAIGN_ID}.PHP_EOL;
                echo $as->{AdSetFields::CONFIGURED_STATUS}.PHP_EOL;
                echo $as->{AdSetFields::START_TIME}.PHP_EOL;
                echo date('Y-m-d', strtotime($as->{AdSetFields::START_TIME})).PHP_EOL;
                echo serialize($as->{AdSetFields::TARGETING}).PHP_EOL;
                echo '----------------------------------------------------'.PHP_EOL;
                
        }
        
        //dd($this->ad_set);
    }
}

/*
 * const ACCOUNT_ID = 'account_id';
  const ADSET_SCHEDULE = 'adset_schedule';
  const BID_AMOUNT = 'bid_amount';
  const BILLING_EVENT = 'billing_event';
  const BUDGET_REMAINING = 'budget_remaining';
  const CAMPAIGN_ID = 'campaign_id';
  const CREATED_TIME = 'created_time';
  const CREATIVE_SEQUENCE = 'creative_sequence';
  const DAILY_BUDGET = 'daily_budget';
  const END_TIME = 'end_time';
  const ID = 'id';
  const IS_AUTOBID = 'is_autobid';
  const LIFETIME_BUDGET = 'lifetime_budget';
  const LIFETIME_IMPS = 'lifetime_imps';
  const NAME = 'name';
  const OPTIMIZATION_GOAL = 'optimization_goal';
  const PACING_TYPE = 'pacing_type';
  const RF_PREDICTION_ID = 'rf_prediction_id';
  const START_TIME = 'start_time';
  const UPDATED_TIME = 'updated_time';
  const TARGETING = 'targeting';
  const PROMOTED_OBJECT = 'promoted_object';
  const ADLABELS = 'adlabels';
  const PRODUCT_AD_BEHAVIOR = 'product_ad_behavior';
 */