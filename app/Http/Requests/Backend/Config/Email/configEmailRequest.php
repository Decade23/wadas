<?php

namespace App\Http\Requests\Backend\Config\Email;

use Illuminate\Foundation\Http\FormRequest;

class configEmailRequest extends FormRequest
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
        if (request()->method === 'PUT')
        {
            return [
                'name' => 'required|email|unique:config_email,name,'.request()->id,
                'visibility' => 'required'
            ];
        }
        return [
            'name' => 'required|unique:config_email|email',
            'visibility' => 'required'
        ];
    }
}
