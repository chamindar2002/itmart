<?php

namespace Allison\AllisonFbApiHelpers\helpers;

use Allison\models\FbProfile;
use Auth;

/**
 * Description of Fb_AccessTokenValidator.
 *
 * @author Chaminda
 */
class Fb_AccessTokenValidator
{
    private $access_token = null;

    public function __construct()
    {
        if (Auth::user()->fbProfile) {
            $this->access_token = Auth::user()->fbProfile->access_token;
        }
    }

    public function tokenExists()
    {
        if (!$this->tokenIsExpired()) {
            if ($this->access_token) {
                return true;
            }
        }

        return false;
    }

    public function tokenIsExpired()
    {
        # this method to be implement later
        return false;
    }


}
