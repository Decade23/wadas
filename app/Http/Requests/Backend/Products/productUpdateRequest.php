<?php

namespace App\Http\Requests\Backend\Products;

use Illuminate\Foundation\Http\FormRequest;

class productUpdateRequest extends FormRequest
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
            'name'          => 'required|unique:products,name,'.request()->id,
            'group'         => 'required|exists:groups,id',
            'short_desc'    => 'required',
            'description'   => 'required',
            'visibility'    => 'required',
            'price'         => 'required|min:0'
        ];
    }
}
