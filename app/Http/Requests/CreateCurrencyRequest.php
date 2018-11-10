<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCurrencyRequest extends FormRequest
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
            'icon'  =>  'required',
            'exchange'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'name'  =>  'Vui lòng điền tên loại tiền',
            'code'    =>  'Vui lòng điền mã loại tiền',
            'icon'  =>  'Vui lòng điền ký hiệu loại tiền',
            'exchange'  =>  'Vui lòng điền quy đổi tiền chính'
        ];
    }
}
