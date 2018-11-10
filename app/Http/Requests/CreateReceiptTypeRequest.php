<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReceiptTypeRequest extends FormRequest
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
            'code'    =>  'required',
            'name'    =>  'required',
            'type'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  =>  'Vui lòng điền tên khoản',
            'code.required'    =>  'Vui lòng điền mã khoản',
            'type.required'  =>  'Vui lòng chọn loại khoản'
        ];
    }
}
