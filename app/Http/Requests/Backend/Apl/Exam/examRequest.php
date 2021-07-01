<?php

namespace App\Http\Requests\Backend\Apl\Exam;

use Illuminate\Foundation\Http\FormRequest;

class examRequest extends FormRequest
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
            'product'   => 'required',
            'title'     => 'required',
            'desc'      => 'required',
            'visibility'        => 'required',
            'question'          => 'required',
            'radio_answer'      => 'required',
            'txt_anser'         => 'required'
        ];
    }
}
