<?php

namespace App\Http\Requests\Backend\Sales;

use Illuminate\Foundation\Http\FormRequest;

class salesRequest extends FormRequest
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
        $memberId = null;

        if (isset($this->request->get('member')['id'])) {
            $memberId = $this->request->get('member')['id'];
        }

        //$toReturn = false;
        //dd(request()->all());
        return [
            'orderDate'            => 'required',
            'type'                  => 'required',
            'paymentStatus'        => 'required',
            'member.name'           => 'required',
            'member.email'          => 'required|unique:users,email,'.$memberId,
            'member.phone'          => 'required',
            'products.*.product_id' => 'required',
        ];
    }
}
