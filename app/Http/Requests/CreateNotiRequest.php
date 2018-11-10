<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNotiRequest extends FormRequest
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
            'title'  =>  'required',
            'content'    =>  'required',
            'web_id'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'  =>  'Vui lòng điền tiêu đề thông báo',
            'content.required'    =>  'Vui lòng điền nội dung',
            'web_id.required'  =>  'Vui lòng chọn website cần gửi',
        ];
    }
}
