<?php

namespace Allison\Http\Requests;

use Allison\Http\Requests\Request;

class FbAdCreativeRequest extends Request
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
            'title' => 'required|max:150',
            'body' => 'required',
            'object_url' => 'required',
            'media_d' => 'required'
        ];
    }
}
