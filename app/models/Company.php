<?php
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 7/18/16
 * Time: 12:52 PM
 */

namespace Allison\models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table = 'companies';


    public function members(){
        return $this->belongsToMany('Allison\models\Member');
    }

}