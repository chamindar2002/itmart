<?php

namespace Allison\models\FbAd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdCampaign extends Model
{
    protected $table = 'fb_ad_campaigns';

    protected $fillable = ['name', 'objective', 'status'];

    use SoftDeletes;

    public function fbProfile()
    {
        return $this->belongsTo('Allison\models\FbProfile');
    }

    public function adSets()
    {
        return $this->hasMany('Allison\models\FbAd\AdSet');
    }
}
