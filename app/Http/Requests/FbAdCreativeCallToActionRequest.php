<?php

namespace Allison\Http\Requests;

use Allison\Http\Requests\Request;

class FbAdCreativeCallToActionRequest extends Request
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
        
        if($this->ad_type == 'link_ad_connected_to_page'){
            #if its a page link ad
            return [
               'name' => 'required|max:150',
               'ldf_message' => 'required|max:255',
               'object_url' => 'required',
               'ldf_caption' => 'required|max:50',
               'page_id' => 'required', 
               'media_d' => 'required'
            ];
            
            
        }elseif( $this->ad_type == 'video_page_like_ad'){
            
            #if its a video page like ad
            return [
               'name' => 'required|max:150',
               'ldf_message' => 'required|max:255',
               'thumb_image_url' => 'required',
               'video_id' => 'required', 
               'page_id' => 'required'
            ];
            
        }elseif($this->ad_type == 'ad_from_existing_page_post'){
            
            #if its a video page like ad
            return [
               'name' => 'required|max:150',
               'post_id' => 'required|max:255',
               
            ];
            
        }elseif($this->ad_type == 'carousel_ad'){

            return [
                'name' => 'required|max:150',
                'page_id' => 'required',
                'products' => 'required',
                'object_url' => 'required'

            ];

        }else{
            #it is a  Link Ad with a call to action
            return [
               'name' => 'required|max:150',
               'ldf_message' => 'required|max:255',
               'object_url' => 'required',
               'ldf_caption' => 'required|max:50',
               'ldf_call_to_action_type' => 'required',
               'page_id' => 'required', 
            ];
        }
    }
    
    public function messages()
    {
        return [
            'ldf_message.required' => 'Message is required',
            'object_url.required' => 'Url is required',
            'ldf_caption.required' => 'Caption is required',
            'ldf_call_to_action_type.required' => 'Call to action type is required',
            'media_d.required' => 'A media is required',
            'post_id.required' => 'Page post id is required'
        ];
    }
}
