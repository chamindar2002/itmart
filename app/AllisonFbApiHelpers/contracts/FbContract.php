<?php

namespace Allison\AllisonFbApiHelpers\contracts;

use FacebookAds\Api;
use Auth;
use Log;
use Session;
use Redirect;

/**
 * Description of FbContract.
 *
 * @author Chaminda
 */
abstract class FbContract
{
    #User's (current) Access token
    protected $access_token;

    #Messages incurred from exeption handling
    protected $exceptions;
    
    protected $exception_code;
    
    protected $exception_sub_code;


    protected $exception_message;
    
    protected $exception_user_title;
    
    protected $exception_user_message;

    #Add Acount Id 
    protected $add_account_id;

    protected $success = false;

    final public function __construct()
    {
        $this->init();

        if (Auth::user()->fbProfile) {
            $this->access_token = Auth::user()->fbProfile->access_token;
        }

       // set_time_limit(1000000);

        Api::init(
          Config('facebook.APP_ID'), //APP_ID,
          Config('facebook.APP_SECRET'), //APP_SECRET
          $this->access_token //ACCESS_TOKEN
        );
    }

    final public function getExceptions()
    {
        return $this->exceptions;
    }
    
    final public function getExceptionCode()
    {
        if($this->exception_sub_code == null){
            return $this->exception_code;
        }

        $this->exception_sub_code;
    }
    
    final public function getExceptionMessage()
    {
        return $this->exception_message.' ['.$this->exception_user_message.']';
    }

    public function handleRequestException($e=null)
    {
        /*
         * pass exception object thrown from PHP SDK Request Exception handler.
         */
        if($e != null){
        $this->exceptions = 'Caught Exception: '.$e->getMessage().PHP_EOL
                                .'Code: '.$e->getCode().PHP_EOL
                                .'HTTP status Code: '.$e->getHttpStatusCode().PHP_EOL
                                .'Error Subcode: '.$e->getErrorSubcode().PHP_EOL
                                .'Error User Title: '.$e->getErrorUserTitle().PHP_EOL
                                .'Error User Message: '.$e->getErrorUserMessage().PHP_EOL;
        
        $this->exception_code = $e->getCode();
        $this->exception_sub_code = $e->getErrorSubcode();
        $this->exception_message = $e->getMessage();
        $this->exception_user_title = $e->getErrorUserTitle();
        $this->exception_user_message = $e->getErrorUserMessage();
        }

        #temporary dump exceptions. need to handle this later
        Log::error($this->exceptions);
        
        //Session::flash('alert-danger', $this->exceptions);\
        //return Redirect::to('login');
//        return array(
//                    'exceptions'=>  $this->exceptions,
//                    'code'=>  $this->exception_code,
//                );
        
        //die($this->exceptions);
    }

    /*
     * @return void
     */
    abstract public function init();
    
    public function getAdAccountId(){
        return $this->add_account_id;
    }
}
