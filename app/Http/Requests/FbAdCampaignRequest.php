<?php

namespace Allison\Http\Requests;

class FbAdCampaignRequest extends Request
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
        return [
            'name' => 'required|max:100',
            'objective' => 'required|max:50',
            'status' => 'required|max:20',
        ];
    }
}
