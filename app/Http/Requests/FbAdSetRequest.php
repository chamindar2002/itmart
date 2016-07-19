<?php

namespace Allison\Http\Requests;

use Session;

class FbAdSetRequest extends Request
{
    public function __construct()
    {
        
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        Session::put('selected_target_groups', $this->selected_target_groups);
        
        #common rules
       $rules = array(
           'name' => 'required|max:100',
            //'target_id' => 'required',
            'campaign_id' => 'required',
            'start_time' => 'required|before:end_time',
            'end_time' => 'required|after:start_time',
            'bid_amount' => 'required|numeric|min:2|max:10', #temporary
            'daily_budget' => 'required|numeric|min:10|max:100', #temporary
       );
         
//        return [
//            'name' => 'required|max:100',
//            'campaign_id' => 'required',
//            'start_time' => 'required|before:end_time',
//            'end_time' => 'required|after:start_time',
//            'bid_amount' => 'required|numeric|min:2|max:10', #temporary
//            'daily_budget' => 'required|numeric|min:10|max:100', #temporary
//            //'selected_target_groups' => 'required'
//            
//            //'optimization_goals' => 'required' #default set to none
//
//        ];

         //dd($this->searchType);
        
         if($this->targeting_search_types == 'INTEREST'){
             
             $rules['selected_target_groups'] = 'required';
             
         }elseif($this->targeting_search_types == 'GEOLOCATION'){
             
              $rules['geo_location'] = 'required';
              
         }
         
         
      return $rules;
       
    }
    
    public function messages()
    {
        return [
            'selected_target_groups.required' => 'Target interest group is required',
            
        ];
    }
}
