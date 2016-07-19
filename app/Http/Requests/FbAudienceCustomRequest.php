<?php

namespace Allison\Http\Requests;

use Allison\Http\Requests\Request;

use Validator;

use Allison\AllisonFbApiHelpers\helpers\Fb_AudienceUtilities;

class FbAudienceCustomRequest extends Request
{
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
        
       #common rules
       $rules = array(
           'name' => 'required|max:150',
       );
       
       
       if($this->sub_type != null){
           
       
                #on website_traffic selection
                if($this->website_traffic == 'specific_pages'){
                    $rules['url_key_words'] = 'required';
                    $rules['rule_definer'] = 'required';
                }

                #on update
                if($this->method() == 'PATCH'){

                    $rules['retention_days'] = 'required|numeric|min:1|max:180';

                }else{
                    #on create
                    $rules['pixel_id'] = 'required';
                    $rules['sub_type'] = 'required';
                    $rules['retention_days'] = 'required|numeric|min:1|max:180';

                    //return $rules;
                }
        }else{
            
            #on update do not validate data field
            if($this->method() != 'PATCH'){
                #sub_type is null when creating custom audience based on customer list => CustomAudienceCustomerListController
                 $rules['data'] = 'required|custom_audience_validate_batch_data_count';
                 Validator::extend('custom_audience_validate_batch_data_count', function($attribute, $value, $parameters)
                 {
                     #helpful - custom validation => http://laraveldaily.com/how-to-customize-error-messages-in-request-validation/
                     if(sizeof(Fb_AudienceUtilities::format_customer_list($value)) >= 20){
                         return true;
                     }
                     return false;
                 });
            }
        }
       
       return $rules;
    }
    
}
