<?php

namespace Allison\models\FbAd;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdPublish extends Model
{
    use SoftDeletes;
    
    protected $table = 'fb_ad_publish';
    
    public function fbProfile()
    {
        return $this->belongsTo('Allison\models\FbProfile');
    }
    
    public function adCreative()
    {
        return $this->belongsTo('Allison\models\FbAd\AdCreative');
    }
    
    public function adSet()
    {
        return $this->belongsTo('Allison\models\FbAd\AdSet');
    }
}
