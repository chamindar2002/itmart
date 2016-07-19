<?php

namespace Allison\models\FbAudience;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Validator;

class AudiencePixel extends Model
{
    use SoftDeletes;
    
    protected $table = 'fb_audience_pixel';
    
    public static function rules(){
        
        return array(
                        'name' => 'required'
                    );
        
    }
    
    public static function validate($request){
      
        return Validator::make($request->all(), [
            
             'name' => 'required',
            
        ]);
    }
    
    
    
    public function adAccount()
    {
        return $this->belongsTo('Allison\models\FbAd\AdAccount');
    }
}
