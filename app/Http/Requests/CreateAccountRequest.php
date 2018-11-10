<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
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
            'code'    =>  'required',
            'type'  =>  'required',
            'currency_id'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  =>  'Vui lòng điền tên tài khoản',
            'code.required'    =>  'Vui lòng điền mã tài khoản',
            'type.required'  =>  'Vui lòng chọn loại tài khoản',
            'currency_id.required'  =>  'Vui lòng chọn loại tiền tệ'
        ];
    }
}
