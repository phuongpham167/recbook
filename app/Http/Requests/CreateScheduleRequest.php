<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateScheduleRequest extends FormRequest
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
            'time'  =>  'required',
            'content'  =>  'required',
//            'user_id'  =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  =>  'Vui lòng điền tên Lịch hẹn',
            'time.required'  =>  'Vui lòng điền Thời gian cuộc hẹn',
            'content.required'  =>  'Vui lòng điền Nội dung cuộc hẹn',
//            'user_id.required'  =>  'Vui lòng điền tên Người hẹn'
        ];
    }
}
