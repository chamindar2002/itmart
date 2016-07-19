<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;

use Auth;

class FetchPixel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:pixel';

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
        $access_token = 'CAAPgIZBacbTMBAEjLWv3soPZBquvpDAHzNIpEQLh6GzWSpiyY9Bjoy4LSHgQG5Q3u9TzUJ4E3rnf9BL10OIQzRsmSIsDKKJSWQQQC1Dn93c3TyZCIlz0AYZA1Ril8RrQWSVhf7BQZBEY5Kfs1D1enDmzonuaBcG8GugpKsB0Ad9g0FlFDuTXutaU8ml6Lzt4ZD';
        $appsecret_proof = hash_hmac('sha256', $access_token, Config('facebook.APP_SECRET')); 

        $params = array(
                'access_token'=>$access_token,
                'appsecret_proof'=>$appsecret_proof
         );
        
        $ad_account = 'act_1637309866543107';
       
            $postdata = http_build_query($params);
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/v2.5/".$ad_account."/adspixels?".$postdata);
            curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
            $header[] = 'Content-Type: text/xml; charset=UTF-8';
            //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
            curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
      
            $response = curl_exec($handle);
            var_dump($response);
    }
}
