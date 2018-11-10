<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAreaRequest extends FormRequest
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
            'province_input'  =>  'unique:province,name',
            'district_input'  =>  'unique:district,name',
            'ward_input'  =>  'unique:ward,name',
            'street_input'  =>  'unique:street,name'
        ];
    }

    public function messages()
    {
        return [
            'province_input.unique'  =>  'Tỉnh đã tồn tại!',
            'district_input.unique'  =>  'Quận/Huyện/TP đã tồn tại!',
            'ward_input.unique'  =>  'Phường/Xã đã tồn tại!',
            'street_input.unique'  =>  'Đường Phố đã tồn tại!'
        ];
    }
}
