<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReceiptRequest extends FormRequest
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
            'account_id'  =>  'required',
            'code'    =>  'required',
            'receipt_type_id'  =>  'required',
            'value'  =>  'required',
            'target_user_id'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'account_id.required'  =>  'Vui lòng điền tên tài khoản',
            'code.required'    =>  'Vui lòng điền số phiếu',
            'receipt_type_id.required'  =>  'Vui lòng chọn khoản thu chi',
            'value.required'  =>  'Vui lòng điền giá trị tiền mặt',
            'target_user_id.required'  =>  'Vui lòng điền tên người nhận'
        ];
    }
}
