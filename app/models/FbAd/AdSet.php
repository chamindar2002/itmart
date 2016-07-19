<?php

namespace Allison\models\FbAd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdSet extends Model
{
    protected $table = 'fb_ad_sets';
    
    public $selected_defualt = null;

    protected $fillable = [
        'name',
        'campaign_id',
        'fb_profile_id',
        'optimization_goals',
        'bid_amount',
        'daily_budget',
        'start_time',
        'end_time',
        ];

    use SoftDeletes;

    public function adCampaign()
    {
        return $this->belongsTo('Allison\models\FbAd\AdCampaign', 'campaign_id');
    }

    public function fbProfile()
    {
        return $this->belongsTo('Allison\models\FbProfile');
    }
    
    public function ads()
    {
        return $this->hasMany('Allison\models\FbAd\AdPublish');
    }
}
