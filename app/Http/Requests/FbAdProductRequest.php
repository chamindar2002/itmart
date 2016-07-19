<?php
namespace Allison\Http\Requests;


class FbAdProductRequest extends Request
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
            'product_name' => 'required|max:100',
            'product_description' => 'required|max:100',
            'media_id' => 'required',
            'product_url'=>'required'
        ];
    }
}
