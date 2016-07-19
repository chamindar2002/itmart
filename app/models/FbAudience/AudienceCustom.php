<?php

namespace Allison\models\FbAudience;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AudienceCustom extends Model
{
    use SoftDeletes;
    
    protected $table = 'fb_audience_custom';
    
    public function adAccount()
    {
        return $this->belongsTo('Allison\models\FbAd\AdAccount');
    }
    
    public function fbProfile()
    {
        return $this->belongsTo('Allison\models\FbProfile');
    }
    
    public function audienceLookalike(){
        $this->hasMany('Allison\models\FbAudience\AudienceLookalike');
    }
    
}
