<?php

namespace Allison\models\FbAd;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Validator;

use Input;

class AdMedia extends Model
{
    use SoftDeletes;
    
    protected $table = 'fb_ad_media';

    private static $accepted_files = ['jpg','png','jpeg'];
    private static $accepted_video_files = ['mp4','3gp','avi'];
    
    public function fbProfile()
    {
        return $this->belongsTo('Allison\models\FbProfile');
    }
    
    public static function rules($file, $media_type){


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
                                (Fb_AdUtilities::file_upload_max_size() / (1024 * 1024)).'MB. '.
                                'Facebook Allow upto '.config('facebook.MEDIA_MAX_SIZE') / (1024 * 1024).'MB',

                    );

        //dd(Validator::make($file, self::rules($file, $media_type), $messages));
        return Validator::make($file, self::rules($file, $media_type), $messages);
         
    }
    
    public function adcreatives(){
        return $this->belongsToMany('Allison\models\AdCreatives');
    }

    public function products()
    {
        return $this->hasMany('Allison\models\FbAd\AdProduct');
    }
    
     
}
