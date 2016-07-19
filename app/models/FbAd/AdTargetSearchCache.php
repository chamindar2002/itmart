<?php

namespace Allison\models\FbAd;

use Illuminate\Database\Eloquent\Model;

class AdTargetSearchCache extends Model
{
    protected $table = 'fb_ad_target_search_caches';
    
    public function cached_searches(){
        return $this->hasMany('Allison\models\FbAd\AdTargetGroup');
    }
}
