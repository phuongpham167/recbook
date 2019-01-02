<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormUserRequest extends FormRequest
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
            'phone'  =>  'required',
            'address'  =>  'required',
            'password'  =>  'required|min:6',
            'repassword'  =>  'required|min:6',
            'company_name'  =>  'required',
            'taxcode'  =>  'required',
            'email' =>   [
                'required',
                'email',
                'unique:users'
//                Rule::unique('users')->ignore(auth()->user()->id),
            ],
//            'password'  =>  'required',
//            'group_id'  =>  'required',
//            'branch_id' =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  =>  'Vui lòng điền Tên đăng nhập',
            'phone.required'  =>  'Vui lòng điền số điện thoại',
            'address.required'  =>  'Vui lòng điền địa chỉ',
            'password.required'  =>  'Vui lòng điền mật khẩu',
            'repassword.required'  =>  'Vui lòng nhập lại mật khẩu',
            'company_name.required'  =>  'Vui lòng điền họ tên/ tên công ty',
            'email.required'  =>  'Vui lòng điền email',
            'email.unique'  =>  'Email đã được sử dụng',
            'email.email'  =>  'Định dạng email chưa chính xác',
            'taxcode.required'  =>  'Vui lòng điền CMT/ Mã số thuế'
        ];
    }
}
