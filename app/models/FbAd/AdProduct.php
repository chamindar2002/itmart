<?php

namespace Allison\models\FbAd;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdProduct extends Model
{
    use SoftDeletes;

    protected $table = 'fb_ad_products';

    public static function rules(){

        return array(
            //'media_file' => 'required'
        );

    }

    public function fbProfile()
    {
        return $this->belongsTo('Allison\models\FbProfile');
    }

    public function media()
    {
        return $this->belongsTo('Allison\models\FbAd\AdMedia');
    }

    public function adCreatives(){
        return $this->belongsToMany('Allison\models\AdCreatives');
    }

}
