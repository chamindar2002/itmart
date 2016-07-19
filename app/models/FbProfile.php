<?php

namespace Allison\models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class FbProfile extends Model
{
    protected $table = 'facebook_profiles';

    public function user()
    {
        return $this->belongsTo('Allison\User');
    }

    public function campaigns()
    {
        return $this->hasMany('Allison\models\FbAd\AdCampaign');
    }

    public function adSets()
    {
        return $this->hasMany('Allison\models\FbAd\AdSet');
    }
    
    public function adCreatives()
    {
        return $this->hasMany('Allison\models\FbAd\AdCreative');
    }
    
    public function ads()
    {
        return $this->hasMany('Allison\models\FbAd\AdPublish');
    }
    
    public function customAudiences()
    {
        return $this->hasMany('Allison\models\FbAudience\AudienceCustom');
    }
    
    public function audienceLookalike()
    {
        $this->hasMany('Allison\models\FbAudience\AudienceLookalike');
    }

    public function products()
    {
        return $this->hasMany('Allison\models\FbAd\AdProduct');
    }

    public static function getAdminProfile()
    {
       //return self::find(3);
        $value = Cache::remember('admin_profile_cache', 1440, function(){
            return self::find(1);
            //return self::find(3);
        });

       return $value;
    }
    
}
