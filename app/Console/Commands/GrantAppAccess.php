<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class GrantAppAccess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grant:app-access';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        #doc -> https://developers.facebook.com/docs/graph-api/reference/v2.5/app/roles
        $access_token = 'EAAPgIZBacbTMBAPbsLKVdt0lRJt70S1xb2LXLufNta9pedDnCHAU6CvLPLZCC7mLwTwoa89DTbXUswUj6Ogv1fwtgbG9ipqZBUZCGX9g77HHHXi5V1b8LspTWvT0mzB3ZCkozAqlTwvnXypfJm7OSBhercB7FCvsZD';
        $appsecret_proof= hash_hmac('sha256', $access_token, Config('facebook.APP_SECRET'));

        $params = array(
            'access_token'=>$access_token,
            'appsecret_proof'=>$appsecret_proof
        );

        $API_VERSION = Config('facebook.API_VERSION');

        //dd($params);

        $user_id = '105572156500515'; #user id of the user to be gratend role (690494351 myself)
        $role = 'developers'; //roles : 'administrators', 'developers', 'testers', 'insights users'

        $postdata = http_build_query($params);
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/$API_VERSION/".Config('facebook.APP_ID')."/roles?user=$user_id&role=$role&".$postdata);
        curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
        $header[] = 'Content-Type: text/xml; charset=UTF-8';
        //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($handle);

        dd($response);

    }
}
