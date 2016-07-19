<?php

namespace Allison\models\FbAudience;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AudienceLookalike extends Model
{
    use SoftDeletes;
    
    protected $table = 'fb_audience_lookalike';
    
    public function adAccount()
    {
        return $this->belongsTo('Allison\models\FbAd\AdAccount');
    }
    
    public function adCustomAudience()
    {
        return $this->belongsTo('Allison\models\FbAudience\AudienceCustom');
    }
    
    public function fbProfile()
    {
        return $this->belongsTo('Allison\models\FbProfile');
    }
}
