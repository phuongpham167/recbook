<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCareRequest extends FormRequest
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
            'content'   =>  'required',
            'feedback'  =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'content.required'   =>  'Vui lòng điền nội dung chăm sóc!',
            'feedback.required'  =>  'Vui lòng điền nội dung phản hồi!'
        ];
    }
}
