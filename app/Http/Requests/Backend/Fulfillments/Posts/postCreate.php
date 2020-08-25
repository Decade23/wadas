<?php

namespace App\Http\Requests\Backend\Fulfillments\Posts;

use Illuminate\Foundation\Http\FormRequest;

class postCreate extends FormRequest
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
            'name'          => 'required|unique:cms_posts,name',
            'product'       => 'nullable|exists:products,id',
            'short_content' => 'required',
            'content'       => 'required',
            'visibility'    => 'required',
        ];
    }
}
