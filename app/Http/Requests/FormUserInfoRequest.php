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
            'full_name'  =>  [
                Rule::unique('user_info')->ignore(auth()->user()->userinfo->id),
                'required'],
            'certificate' => 'mimes:jpeg,bmp,png,jpg',
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
            'full_name.required'  =>  'Vui lòng điền họ tên',
            'full_name.unique'  =>  'Tên này đã tồn tại, vui lòng đặt tên khác!',
            'company.required'  =>  'Vui lòng điền nơi làm việc',
            'identification.required'  =>  'Vui lòng điền số chứng minh/mã số thuế',
            'phone.required'  =>  'Vui lòng điền số điện thoại',
            'province_id.required'  =>  'Vui lòng chọn tỉnh/thành',
            'address.required'  =>  'Vui lòng điền địa chỉ',
            'description.required'  =>  'Vui lòng điền mô tả',
            'certificate.mimes' => 'File chứng chỉ phải có định dạng là: jpeg, bmp, png, jpg'
        ];
    }
}
