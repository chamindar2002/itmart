<?php

namespace Allison\models\FbAd;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Validator;


class AdAccount extends Model
{
    
    use SoftDeletes;
    
    protected $table = 'fb_ad_account';
    
    public static function rules(){
        
        return array(
                        'ad_account_id' => 'required'
                    );
        
    }
    
    public static function validate($request){
      
        return Validator::make($request->all(), [
            
            //'ad_account_id' => 'required|unique:fb_ad_account,ad_account_id|numeric',
            'ad_account_id' => 'required|numeric',
            
        ]);
    }
    
    public function user()
    {
        return $this->belongsTo('Allison\User');
    }
    
    public function pixel(){
        $this->hasOne('Allison\models\FbAudience\AudiencePixel');
    }
    
    public function audienceCustom(){
        $this->hasMany('Allison\models\FbAudience\AudienceCustom');
    }
    
    public function audienceLookalike(){
        $this->hasMany('Allison\models\FbAudience\AudienceLookalike');
    }
}
