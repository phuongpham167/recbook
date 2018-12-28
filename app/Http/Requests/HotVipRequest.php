<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotVipRequest extends FormRequest
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
            'hot_time' => 'in:1,7,30,90',
            'vip_time' => 'in:1,7,30,90'
        ];
    }

    public function messages()
    {
        return [
            'hot_time.in' => 'Số ngày tin Hot không hợp lệ',
            'vip_time' => 'Số ngày tin Vip không hợp lệ'
        ];
    }
}
