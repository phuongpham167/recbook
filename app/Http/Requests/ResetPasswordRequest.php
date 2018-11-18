<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password'  =>  ['confirmed','required']
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed'    =>  'Xác nhận mật khẩu chưa chính xác!',
            'password.required'     =>  'Vui lòng điền mật khẩu mới'
        ];
    }
}
