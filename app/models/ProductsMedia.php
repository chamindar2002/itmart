<?php
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 7/20/16
 * Time: 10:58 AM
 */

namespace Allison\models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Input;

class ProductsMedia extends Model
{

    protected $table = 'fb_ad_media';

    private static $accepted_files = ['jpg','png','jpeg'];
    private static $accepted_video_files = ['mp4','3gp','avi'];

    public static function rules(){


        $rules = array(
            'media_file' => 'required|valid_file_type|max_file_size'
        );

        //dd(Input::file('media_file')->getSize());

        if(Input::file('media_file') != null){

            $media_file = Input::file('media_file')->getClientOriginalExtension();

            //dd($media_file);

            //if(!in_array($media_file, self::$accepted_files)){

            Validator::extend('valid_file_type', function($attribute, $value, $parameters)
            {
                $media_file = Input::file('media_file')->getClientOriginalExtension();

                if(!in_array($media_file, self::$accepted_files)) {

                    return false;
                }else{

                    return true;
                }
            });
            //}
        }

        Validator::extend('max_file_size', function($attribute, $value, $parameters)
        {

            if(Input::file('media_file')->getSize() > config('facebook.MEDIA_MAX_SIZE')) {

                return false;
            }else{

                return true;
            }
        });

        return $rules;

    }


    public static function validate($file, $media_type='image'){

        $supported_types = '';

        //dd($file);

        if($media_type == 'video'){
            self::$accepted_files = self::$accepted_video_files;
        }

        //dd(self::$accepted_files);

        foreach(self::$accepted_files as $k=>$v){

            $supported_types .= "$v";

            if(end(self::$accepted_files) != $v) {
                $supported_types .= ", ";
            }
        }

        $messages = array(
            'valid_file_type' => "The file you are trying to upload is not a supported format. ".
                "Supported types are : ".$supported_types,
            'max_file_size' => "The file is too large. Allowed file size is ".config('facebook.MEDIA_MAX_SIZE') / (1024 * 1024).'MB',
            'required' => 'Please check the size of the file you are trying to upload. Configured Size is in your server is '.
                (self::file_upload_max_size()/ (1024 * 1024)).'MB. '.
                'Facebook Allow upto '.config('facebook.MEDIA_MAX_SIZE') / (1024 * 1024).'MB',

        );

        //dd(Validator::make($file, self::rules($file, $media_type), $messages));
        return Validator::make($file, self::rules($file, $media_type), $messages);

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



}