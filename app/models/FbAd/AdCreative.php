<?php

namespace Allison\models\FbAd;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdCreative extends Model
{
    use SoftDeletes;
    
    protected $table = 'fb_ad_creative';
    
    protected $fillable = [
      'fb_profile_id', 'name', 'title', 'body', 'object_url', 'ad_creative_id'  
    ];
    
    
    public function media(){
        return $this->belongsToMany('Allison\models\FbAd\AdMedia');
    }
    
    public function fbProfile()
    {
        return $this->belongsTo('Allison\models\FbProfile');
    }
    
    public function ads()
    {
        return $this->hasMany('Allison\models\FbAd\AdPublish');
    }

    public function products(){
        return $this->belongsToMany('Allison\models\FbAd\AdProduct');
    }
}
