<?php

namespace Allison\AllisonFbApiHelpers\helpers;

/**
 * Description of Fb_TraitAdAccountAssigner.
 *
 * @author Oracle
 */
use Auth;

class Fb_AdAccountAssigner
{
    public static function getAddAccountId()
    {

       /*
        * if ad account to be assigned dynamyically, 
        * you may build the logic here and return the account id
        * 
        */

       # act_104612129907662 //ad Account allisondev782@gmail.com
       # act_1637309866543107 //Ad Account for Developer Testing (allison business account)
       # act_1149216671774221 //Suite sysndication account (suite syndicator business account)

       #return 'act_1637309866543107';

       /*
        * set ad account dynamically
        */
       if(isset(Auth::user()->fbAdAccount->ad_account_id))
               return Auth::user()->fbAdAccount->ad_account_id;
    }
}
