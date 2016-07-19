<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class FBGetUserId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
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
//    public function handle()
//    {
//        $at = 'CAAPgIZBacbTMBAI384ZC0XTI5RKumn6En8JjByYTEFuY6S1xBZA35vTl8DUFEZCoRCqxwolUhz1uhMfOlvgpFDQMiGrkmL6AWL2nOtsV1mt00ht5WsWBWPX8XSQZCuha9hjYZBK8MnEkqDxWocMSrswn6Le90pPeW80lmpsC7GZAjVjZAhk8jrWaQU6nK0JYsm8ZD';
//        $appsecret_proof = hash_hmac('sha256', $at, Config('facebook.APP_SECRET'));
//
//        $params = array(
//                'access_token' => $at,
//                'fields' => 'id,email,name,gender',
//                //'fields' => 'id',
//                'appsecret_proof' => $appsecret_proof,
//        );
//
//        
//        $client = new Client();
//        $request = $client->get('https://graph.facebook.com/200708736934398?', $params);
//        $response = $request->send();
//
//
//      var_dump($response);
//    }
    
    public function handle()
    {
        define("ACCESS_TOKEN","CAAPgIZBacbTMBAI384ZC0XTI5RKumn6En8JjByYTEFuY6S1xBZA35vTl8DUFEZCoRCqxwolUhz1uhMfOlvgpFDQMiGrkmL6AWL2nOtsV1mt00ht5WsWBWPX8XSQZCuha9hjYZBK8MnEkqDxWocMSrswn6Le90pPeW80lmpsC7GZAjVjZAhk8jrWaQU6nK0JYsm8ZD");
        
        $appsecret_proof= hash_hmac('sha256', ACCESS_TOKEN, Config('facebook.APP_SECRET')); 
        
        $params = array(
                'access_token' => ACCESS_TOKEN,
                'fields' => 'id,email,name,gender',
                //'fields' => 'id',
                'appsecret_proof'=>$appsecret_proof
         );
     
        
            $postdata = http_build_query($params);
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/me?".$postdata);
            curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
            $header[] = 'Content-Type: text/xml; charset=UTF-8';
            //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
            curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
      
            $response = curl_exec($handle);
            var_dump($response);
    }
}

/*
 * //http://stackoverflow.com/questions/3546677/how-to-get-the-facebook-user-id-using-the-access-token
        
        $appsecret_proof= hash_hmac('sha256', ACCESS_TOKEN, APP_SECRET); 
        
        $params = array(
                'access_token' => ACCESS_TOKEN,
                'fields' => 'id,email,name,gender',
                //'fields' => 'id',
                'appsecret_proof'=>$appsecret_proof
         );
     
        
            $postdata = http_build_query($params);
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/me?".$postdata);
            curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
            $header[] = 'Content-Type: text/xml; charset=UTF-8';
            //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
            curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
      
            $response = curl_exec($handle);
            var_dump($response);
 */
