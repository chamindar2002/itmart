<?php
namespace Allison\Console\Commands\FbAd;

use FacebookAds\Api;

use Allison\User;

use Allison\models\FbAd\AdAccount;

/**
 * Description of trait FbAppInnitialize
 *
 * @author Efutures
 */
trait FbAppInnitialize {
    //put your code here
    public function init($access_token)
    {
        Api::init(
          Config('facebook.APP_ID'), //APP_ID,
          Config('facebook.APP_SECRET'), //APP_SECRET
          $access_token //ACCESS_TOKEN
        );
    }
    
    public function getAllUsers(){
        
         return User::all();
    }
    
    public function getAllAdAccounts(){
        
        return AdAccount::groupBy('ad_account_id')->get();
    }
    
}
