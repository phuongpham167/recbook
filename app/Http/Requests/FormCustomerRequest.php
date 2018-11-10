<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCustomerRequest extends FormRequest
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
            'name'  =>  'required',
            'phone'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  =>  'Vui lòng điền tên Khách hàng',
            'phone.required'  =>  'Vui lòng điền số điện thoại Khách hàng'
        ];
    }
}
