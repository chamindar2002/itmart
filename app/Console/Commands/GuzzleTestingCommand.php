<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GuzzleTestingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:run';

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
        $access_token = 'CAAPgIZBacbTMBABKhHxLvbk4YDaXuhxxIDhzVyxEE9D59PSj1lZBAZAmZAr6ZCLkyPM6BS6n6SnZBdIVn6bZB0PAYooYjxdNKwZBFoLRNiXtEEsHjWK3RieZB5iTz0872X4R5BTe0LfeuX97yRTLVimVeMGrrFzlmV4W7EFiNHBfbo684ylA1AzE2LYTTpAkN4gLIK3lxZC7eM6AZDZDCAAPgIZBacbTMBABKhHxLvbk4YDaXuhxxIDhzVyxEE9D59PSj1lZBAZAmZAr6ZCLkyPM6BS6n6SnZBdIVn6bZB0PAYooYjxdNKwZBFoLRNiXtEEsHjWK3RieZB5iTz0872X4R5BTe0LfeuX97yRTLVimVeMGrrFzlmV4W7EFiNHBfbo684ylA1AzE2LYTTpAkN4gLIK3lxZC7eM6AZDZD';
        $app_secret = Config('facebook.APP_SECRET');
        $appsecret_proof= hash_hmac('sha256', $access_token, $app_secret);

        $params = array(
                'access_token'=>$access_token,
                //'appsecret_proof'=>$appsecret_proof,

            );
        $postdata = http_build_query($params);

        $ad_account = 'act_1637309866543107';

        $url  = "https://graph.facebook.com/v2.5/".$ad_account."/users?".$postdata;
        $client = new Client();
        //$client->setDefaultOption('verify', false);

         $response = $client->request('GET',$url, ['timeout' => 3.14]);

         dd($response);
       

    }
}
//$appsecret_proof= hash_hmac('sha256', ACCESS_TOKEN, APP_SECRET); 
//        
//            $params = array(
//                'access_token'=>ACCESS_TOKEN,
//                'appsecret_proof'=>$appsecret_proof,
//                
//            );
//            $postdata = http_build_query($params);
//            $handle = curl_init();
//            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
//            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
//            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
//            curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/v2.5/".ADD_ACCOUNT_ID."/users?".$postdata);
//            curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
//            $header[] = 'Content-Type: text/xml; charset=UTF-8';
//            //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
//            curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
//      
//            $response = curl_exec($handle);
//            var_dump($response);