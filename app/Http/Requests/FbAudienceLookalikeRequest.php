<?php

namespace Allison\Http\Requests;

use Allison\Http\Requests\Request;

class FbAudienceLookalikeRequest extends Request
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
            'name' => 'required|max:150',
            'custom_audience_id' => 'required',
            'country_code' => 'required',

        ];
    }
}
