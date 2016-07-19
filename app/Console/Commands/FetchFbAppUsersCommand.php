<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;
use Allison\models\FbProfile;

class FetchFbAppUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:app-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List users who has access to the facebook app';

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
        $admin = FbProfile::getAdminProfile();

        $access_token = Config('facebook.APP_ACCESS_TOKEN');#https://developers.facebook.com/tools/access_token/

        $appsecret_proof= hash_hmac('sha256', $access_token, Config('facebook.APP_SECRET'));


        $params = array(
            'access_token'=>$access_token,
            'appsecret_proof'=>$appsecret_proof
        );

        $API_VERSION = Config('facebook.API_VERSION');

        $postdata = http_build_query($params);
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/$API_VERSION/".Config('facebook.APP_ID')."/roles?".$postdata);
        curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
        $header[] = 'Content-Type: text/xml; charset=UTF-8';
        //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($handle);

        dd($response);





    }
}
