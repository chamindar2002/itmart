<?php

namespace Allison\models\FbAd;

use Illuminate\Database\Eloquent\Model;

class AdTargetGroup extends Model
{
    protected $table = 'fb_target_interest_groups';
    
    public static function render_target_group_selections($group){
        
        if(count($group) > 0 && $group != ""){
            //dd(json_decode($group));
            echo "<ul>";
            foreach(json_decode($group) As $key=>$value){
                
                $data = AdTargetGroup::where('group_id',$value)->first();
               
                if(count($data) > 0){
                    echo "<li><input type='checkbox' class='chk_interests' name='interests[]' value='' disabled='disabled' checked>&nbsp;".$data->name."</li>";
                }
            }
            echo "</ul>";
        }
    }
    
    public function cached_searches()
    {
        return $this->belongsTo('Allison\FbAd\AdTargetSearchCache');
    }
    
}
