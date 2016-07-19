<?php
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 6/14/16
 * Time: 11:48 AM
 */

namespace Allison\AllisonFbApiHelpers\helpers;


use Allison\AllisonFbApiHelpers\contracts\IfFbExceptionCodeHandler;

class Fb_ExceptionCodesHandler implements IfFbExceptionCodeHandler
{
    private $error_code = null;
    private $out_put = null;
    private $message = null;

    public function __construct($code)
    {
        $this->error_code = $code;

    }

    public function handle(){


        switch ($this->error_code) {
            case 1:

                $this->out_put = "<strong>".
                    "Your Facebook account is not verified. You can get it verified from ".
                    "<a target='new' href='https://www.facebook.com/login/reauth.php?next=https%3A%2F%2Fwww.facebook.com%2Fconfirmphone.php&display=popup'>here</a>".
                    "<p>Please verify your account and try again.".
                    "</strong></p>";

                break;

            case 190:

                $this->out_put = '<strong>'.
                                 'Your access token has expired! <br>'.
                                 '<a target="new" href="/Exception/190">Reset your access token here</a>';


                break;

            case 458:
                $this->out_put = '<strong></strong>';

                break;

            case 463:

                $this->out_put = '<strong>'.$this->message.'</strong>';

                break;

            default:
                $this->out_put = "error";
        }

        return $this->out_put;

    }

    public function setErrorCode($code)
    {
        $this->error_code = $code;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }


}