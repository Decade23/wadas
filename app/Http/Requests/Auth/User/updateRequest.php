<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename updateRequest.php
 * @LastModified 17/05/2020, 16:49
 */

namespace App\Http\Requests\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'name'     => 'required|regex:/(^[A-Za-z0-9_-_ ]+$)+/', //|unique:users,name,'.request()->route()->user.'
            'phone'    => 'required',
            'role'     => 'required',
            'password' => 'confirmed',
        ];

        if ( $this->get( 'password' ) !== null ) {
            $rules = [ 'password' => 'confirmed|min:8' ];
        }

        return $rules;
    }
}
