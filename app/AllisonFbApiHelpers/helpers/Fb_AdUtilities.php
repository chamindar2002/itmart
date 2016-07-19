<?php

namespace Allison\AllisonFbApiHelpers\helpers;

/*
 * Description of Fb_AdUtilities
 *
 * @author Chaminda
 */
use FacebookAds\Object\Campaign;

class Fb_AdUtilities
{
    public static function popStatus($status)
    {
        switch ($status) {
            case 'ACTIVE':
                return Campaign::STATUS_ACTIVE;
                break;
            case 'PAUSED':
                return Campaign::STATUS_PAUSED;
                break;
            case 'DELETED':
                return Campaign::STATUS_DELETED;
                break;
            case 'ARCHIVED':
                return Campaign::STATUS_ARCHIVED;
                break;

        }
    }
    

    public static function serialize_data($str)
    {
        return base64_encode(serialize($str));
    }

    public static function unserialize_data($str)
    {
        return unserialize(base64_decode($str));
    }
    
    public static function thumbview_media_path()
    {
        return storage_path().'/ad-images/thumb_images/';
    }
    
    public static function fullview_media_path()
    {
        return storage_path().'/ad-images/full_images/';
    }

    public static function video_media_path(){
        return storage_path().'/ad-videos/';
    }
    
    public static function generateUniqueFileName(){
        return md5(date('Y-m-d H:i:s:u'));
    }
    
    public static function dumpCreateSuccessMessage($txt=null){
        if($txt == null)
            return 'Created Successfully';
        
        
        return $txt;    
    }
    
    public static function dumpUpdateSuccessMessage($txt=null){
        if($txt == null)
            return 'Updated Successfully';
        
        
        return $txt;    
    }

    public static function dumpFailMessage($txt=null){
        if($txt == null)
            return 'Saving data was not successful';


        return $txt;
    }
    
    public static function dumpDeleteSuccessMessage($txt=null){
        if($txt == null)
            return 'Deleted Successfully';
        
        
        return $txt;    
    }
    
    public static function get_dtPicker_dateFormat(){
        return 'dd-mm-yyyy';
        //return 'yyyy-mm-dd';
    }


    public static function file_upload_max_size() {

        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $max_size = self::parse_size(ini_get('post_max_size'));

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = self::parse_size(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }
        return $max_size;
    }

    public static function parse_size($size) {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        }
        else {
            return round($size);
        }
    }

    public static function isValidToken($token){

        //$token = Auth::user()->fbProfile->access_token;
        //$token = 'CAAPgIZBacbTMBAI384ZC0XTI5RKumn6En8JjByYTEFuY6S1xBZA35vTl8DUFEZCoRCqxwolUhz1uhMfOlvgpFDQMiGrkmL6AWL2nOtsV1mt00ht5WsWBWPX8XSQZCuha9hjYZBK8MnEkqDxWocMSrswn6Le90pPeW80lmpsC7GZAjVjZAhk8jrWaQU6nK0JYsm8ZD';

        $appsecret_proof= hash_hmac('sha256', $token, Config('facebook.APP_SECRET'));

        $params = array(
            'access_token' => $token,
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

        curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

        $response = json_decode(curl_exec($handle));

        //dd($response);
        if(property_exists($response, 'error')){
            //dd('error');
            return  false;
        }

        return true;

    }
    
}
