<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
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
            'address'  =>  'required',
            'mobile'  =>  'required',
            'note'  =>  'required',
            'email'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'name'  =>  'Vui lòng điền họ tên',
            'address'  =>  'Vui lòng điền địa chỉ',
            'mobile'  =>  'Vui lòng điền số điện thoại',
            'note'  =>  'Vui lòng điền nội dung yêu cầu',
            'email'  =>  'Vui lòng điền email'
        ];
    }
}
