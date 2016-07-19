<?php
namespace Allison\Console\Commands\FbAd;

use Illuminate\Console\Command;

use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;
use Allison\models\FbAd\AdCampaign;
use Allison\models\FbProfile;
use Allison\Repositories\FbAdcampaign\FbAdcampaignsRepository;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use FacebookAds\Object\Fields\AdUserFields;
use FacebookAds\Http\Exception\AuthorizationException;
#php /vagrant/artisan sync:ad-campaigns

class SyncCampaignsCommand extends Command
{
   
    use FbAppInnitialize;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:ad-campaigns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    private $access_token = null;
    
    private $ad_account_id = null;
    
    private $ad_campaign = null;
    
    private $ad_campaign_repository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FbAdcampaignsRepository $ad_campaign_repository)
    {
        $this->ad_campaign_repository = $ad_campaign_repository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        foreach($this-> getAllAdAccounts() As $ad_account){
            
             $profile = $this->getFbProfile($ad_account->user->id);
             $this->ad_account_id = $ad_account->ad_account_id;
             $this->access_token = $profile->access_token;
             
             echo 'Ad account: '.$ad_account->ad_account_id.PHP_EOL;
             //echo 'access-token: '.$profile->access_token.PHP_EOL;



             #check if token has expired
             if(Fb_AdUtilities::isValidToken($this->access_token)){

                 $this->init($this->access_token);

                 echo 'trying to initialize ad account...'.PHP_EOL;
                 $ad_account = new AdAccount($this->ad_account_id);
                 echo 'initializing ad account success...'.PHP_EOL;


                 echo 'trying to fetch campaigns...'.$this->ad_account_id.PHP_EOL;

                 try{
                     $this->ad_campaign = $ad_account->getCampaigns(array(
                         CampaignFields::ID,
                         CampaignFields::NAME,
                         CampaignFields::OBJECTIVE,
                         CampaignFields::CONFIGURED_STATUS,
                         //configured_status,
                         //Campaign::STATUS_PARAM_NAME,
                     ));

                     echo 'fetch campaigns success...'.PHP_EOL;

                 }catch(AuthorizationException $e){

                     echo 'authorisation exception caught...'.PHP_EOL;
                     continue;

                 }catch (RequestException $e) {

                     echo 'request exception caught...'.PHP_EOL;
                     continue;

                 }



                     //$appsecret_proof = hash_hmac('sha256', $this->access_token, Config('facebook.APP_SECRET'));
                     //echo 'appsecret proof ; '.$appsecret_proof.PHP_EOL;

                     foreach($this->ad_campaign As $ac){
                         echo $ac->{CampaignFields::ID}.PHP_EOL;
                         echo $ac->{CampaignFields::NAME}.PHP_EOL;
                         echo $ac->{CampaignFields::OBJECTIVE}.PHP_EOL;
                         echo $ac->{CampaignFields::CONFIGURED_STATUS}.PHP_EOL;

                         if(!$this->ad_campaign_repository->syncUpdate($ac)){

                             $this->ad_campaign_repository->syncInsert($ac, $profile, $this->ad_account_id);

                         }
                     }
                     echo '---------------------------------------'.PHP_EOL;






             }else{
                 echo 'token expire for ad account. '.$this->ad_account_id.PHP_EOL;
             }
             

             sleep(1);
        }
        exit();
        
        
          
        /*const ID = 'id';
        const ACCOUNT_ID = 'account_id';
        const OBJECTIVE = 'objective';
        const NAME = 'name';
        const IS_COMPLETED = 'is_completed';
        const BUYING_TYPE = 'buying_type';
        const PROMOTED_OBJECT = 'promoted_object';
        const SPEND_CAP = 'spend_cap';
        const ADLABELS = 'adlabels';
        const CREATED_TIME = 'created_time';
        const START_TIME = 'start_time';
        const STOP_TIME = 'stop_time';
        const UPDATED_TIME = 'updated_time';*/
    }
    
    

    
    
    public function getFbProfile($user_id){
        
        return FbProfile::where('user_id', $user_id)->first();
    }
}
