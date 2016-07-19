<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;


//use FacebookAds\Api;

use FacebookAds\Object\TargetingSearch;
use FacebookAds\Object\Search\TargetingSearchTypes;

use FacebookAds\Object\TargetingSpecs;
use FacebookAds\Object\Fields\TargetingSpecsFields;

use \DateTime;
/**
 * Step 4 Create the AdSet
 */
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Values\OptimizationGoals;
use FacebookAds\Object\Values\BillingEvents;

use Allison\Console\Commands\FbAd\FbAppInnitialize;

class FBCreateAddSetCommand extends Command
{
    
    use FbAppInnitialize;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:adset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    private $access_token = null;
    private $ad_account_id = null;
    private $exceptions = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->access_token = 'CAAPgIZBacbTMBAJRassZBb4XZA9FxvI5B5bZCXpTH9FrYjO2WZAt7RaaLkmAqJINYxqY0bWGLYbclqmdpOYfXnZB9dbNocz6rqSS2NCZANy4TZC7qxRknoN9FKkC2vYfw1CvEPagGXGsXEBZCes1rZBWnV6UKjYdFBG8evygDbXnjlego6gnsNii5W60qQ8QSStIwZD';
       $this->ad_account_id = 'act_231184597227956';
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
        
        $targeting = new TargetingSpecs();
        $targeting->{TargetingSpecsFields::GEO_LOCATIONS}
                        = array('countries' => array('GB','US','LK'));
        $targeting->{TargetingSpecsFields::INTERESTS} = array(
            array(
                'id' => '6003149228552',
                'name' => 'Yii',
            ),            
            array(
                'id' => '1602123230009073',
                'name' => 'Laravel',
            ),
             array(
                'id' => '6003650886490',
                'name' => 'CakePHP',
            ),
            
            
        );
        
        $start_time = (new DateTime("+2 week"))->format(DateTime::ISO8601);
        $end_time = (new DateTime("+6 week"))->format(DateTime::ISO8601);

        $adset = new AdSet(null, $this->ad_account_id);
        $adset->setData(array(
          AdSetFields::NAME => 'Php frameworks',
          AdSetFields::OPTIMIZATION_GOAL => OptimizationGoals::REACH,
          AdSetFields::BILLING_EVENT => BillingEvents::IMPRESSIONS,
          AdSetFields::BID_AMOUNT => 2,
          AdSetFields::DAILY_BUDGET => 1000,
          //AdSetFields::CAMPAIGN_ID => '6029886930669',#fetched from FBCreateCampaignCommand
          AdSetFields::CAMPAIGN_ID => '6049110132974', #Milinda silva- 01A
          AdSetFields::TARGETING => $targeting,
          AdSetFields::START_TIME => $start_time,
          AdSetFields::END_TIME => $end_time,
        ));
        
        //dd($adset);
        
        
        
        try {
           $adset->create(array(
            AdSet::STATUS_PARAM_NAME => AdSet::STATUS_PAUSED,
          ));

           echo 'AdSet  ID: '. $adset->id . "\n";
       } catch (\FacebookAds\Http\Exception\RequestException $e) {
           
           $this->exceptions = 'Caught Exception: '.$e->getMessage().PHP_EOL
                                .'Code: '.$e->getCode().PHP_EOL
                                .'HTTP status Code: '.$e->getHttpStatusCode().PHP_EOL
                                .'Error Subcode: '.$e->getErrorSubcode().PHP_EOL
                                .'Error User Title: '.$e->getErrorUserTitle().PHP_EOL
                                .'Error User Message: '.$e->getErrorUserMessage().PHP_EOL;
           dd($this->exceptions);
       }catch(\FacebookAds\Http\Exception\AuthorizationException $e){
           $this->exceptions = 'Caught Exception: '.$e->getMessage().PHP_EOL
                                .'Code: '.$e->getCode().PHP_EOL
                                .'HTTP status Code: '.$e->getHttpStatusCode().PHP_EOL
                                .'Error Subcode: '.$e->getErrorSubcode().PHP_EOL
                                .'Error User Title: '.$e->getErrorUserTitle().PHP_EOL
                                .'Error User Message: '.$e->getErrorUserMessage().PHP_EOL;
           dd($this->exceptions);
       }
        
        
       
        
        //dd($targeting);
    }
}
