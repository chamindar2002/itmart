<?php

namespace Allison\Console\Commands;

use Allison\models\FbProfile;
use Illuminate\Console\Command;
use Mail;
use Allison\User;

class FbAdminTokenExpireryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:admin-token-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get admin use token data (expire time)';

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

        $access_token = $admin->access_token;

        #testing
        //$access_token = 'CAAPgIZBacbTMBAI384ZC0XTI5RKumn6En8JjByYTEFuY6S1xBZA35vTl8DUFEZCoRCqxwolUhz1uhMfOlvgpFDQMiGrkmL6AWL2nOtsV1mt00ht5WsWBWPX8XSQZCuha9hjYZBK8MnEkqDxWocMSrswn6Le90pPeW80lmpsC7GZAjVjZAhk8jrWaQU6nK0JYsm8ZD';

        $appsecret_proof= hash_hmac('sha256', $access_token, Config('facebook.APP_SECRET'));

        $params = array(
            'access_token'=>$access_token,
            'appsecret_proof'=>$appsecret_proof
        );



        $postdata = http_build_query($params);
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handle, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token_info?client_id=".Config('facebook.APP_ID')."&access_token=".$access_token);
        curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
        $header[] = 'Content-Type: text/xml; charset=UTF-8';
        //curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

        $response = json_decode(curl_exec($handle));

        //var_dump($response);
        //$response->access_token);
        //dd($response->expires_in);


        $user = User::findOrFail(1);
        //$url = action('Site\ExceptionController@index', 190);
        $url = 'http://50.17.179.86/Exception/190';#temporary


        if(property_exists($response, 'access_token')){
            //dd(date('h:i:s', $response->expires_in));

            $expire = ceil($response->expires_in / (60*60*24));


            Mail::send('emails.reminder', ['user' => $user, 'url'=>$url, ], function ($m) use ($user, $expire) {
                $m->from('allisondev782@gmail.com', 'Allison Facebook Ad Manager');

                $m->to($user->email, $user->name)->subject('Access Token will expire in '.$expire.' days.');
                $m->cc('chamindar2002@yahoo.com', $name = null);
            });

            echo ' ******* Admin token expires in '.$expire.' days. *******'.PHP_EOL;

            //dd(ceil($response->expires_in / (60*60*24)));
            //exit();

        }else if(property_exists($response, 'error')){

            $error = $response->error->message;

            Mail::send('emails.reminder', ['user' => $user, 'url'=>$url, 'error'=>$error], function ($m) use ($user) {
                $m->from('allisondev782@gmail.com', 'Allison Facebook Ad Manager');

                $m->to($user->email, $user->name)->subject('Access Token has expired');
                $m->cc('chamindar2002@yahoo.com', $name = null);
            });

            echo '******* '.$error.' *******'.PHP_EOL;
            //exit();

        }
    }
}
