<?php

namespace App\Http\Requests\Backend\Apl\Email;

use Illuminate\Foundation\Http\FormRequest;

class emailRequest extends FormRequest
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
        $rules = [
            'from'          => 'required',
            'subject'       => 'required',
            'body_email'    => 'required',
        ];

        if ( request('recipient') == null ) {
            $rules['group'] = 'required';
        }

        if ( request('group') == null ) {
            $rules['recipient'] = 'required';
        }

        return $rules;
    }
}
