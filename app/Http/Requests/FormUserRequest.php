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
            'email' =>   [
                'required',
                'email',
                'unique:users'
//                Rule::unique('users')->ignore(auth()->user()->id),
            ],
            'full_name'  =>  'required',
            'company'  =>  'required',
            'identification'  =>  'required',
            'province_id'  =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'  =>  'Vui lòng điền Tên đăng nhập',
            'password.required'  =>  'Vui lòng điền mật khẩu',
            'password.min'  =>  'Mật khẩu phải có tối thiểu 6 ký tự',
            'repassword.required'  =>  'Vui lòng nhập lại mật khẩu',
            'repassword.min'  =>  'Mật khẩu phải có tối thiểu 6 ký tự',
            'email.required'  =>  'Vui lòng điền email',
            'email.unique'  =>  'Email đã được sử dụng',
            'email.email'  =>  'Định dạng email chưa chính xác',
            'full_name.required'  =>  'Vui lòng điền họ têb',
            'company.required'  =>  'Vui lòng điền nơi làm việc',
            'identification.required'  =>  'Vui lòng điền CMT/ Mã số thuế',
            'province_id.required'  =>  'Vui lòng chọn tỉnh/thành',
            'phone.required'  =>  'Vui lòng điền số điện thoại',
            'address.required'  =>  'Vui lòng điền địa chỉ'
        ];
    }
}
