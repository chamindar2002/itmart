<?php
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 7/18/16
 * Time: 12:04 PM
 */

namespace Allison\models;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    protected $table = 'members';

    public function companies(){
        return $this->belongsToMany('Allison\models\Company');
    }

}
