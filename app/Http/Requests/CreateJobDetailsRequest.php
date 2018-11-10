<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobDetailsRequest extends FormRequest
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
            'executor_id'  =>  'required',
            'details'   =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'executor_id.required'  =>  'Vui lòng điền tên người thực hiện',
            'details.required'  =>  'Vui lòng điền Chi tiết công việc',
        ];
    }
}
