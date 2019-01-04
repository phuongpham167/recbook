<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormUserInfoRequest extends FormRequest
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
            'full_name'  =>  'required',
            'company'  =>  'required',
            'identification'  =>  'required',
            'phone'  =>  'required',
            'province_id'  =>  'required',
            'address'  =>  'required',
            'description'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'  =>  'Vui lòng điền họ têb',
            'company.required'  =>  'Vui lòng điền nơi làm việc',
            'identification.required'  =>  'Vui lòng điền số chứng minh/mã số thuế',
            'phone.required'  =>  'Vui lòng điền số điện thoại',
            'province_id.required'  =>  'Vui lòng chọn tỉnh/thành',
            'address.required'  =>  'Vui lòng điền địa chỉ',
            'description.required'  =>  'Vui lòng điền mô tả',
        ];
    }
}
