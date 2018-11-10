<?php

namespace App\Http\Requests;

use App\Rules\Domain;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateWebRequest extends FormRequest
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
            'code'  =>  'required',
            'email' =>   [
                'required',
                'email',
                Rule::unique('webs')->ignore(request('id')),
            ],
            'website' => [
                'required',
                Rule::unique('webs')->ignore(request('id')),
                new Domain(),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required'  =>  'Vui lòng điền tên đơn vị',
            'code.required'  =>  'Vui lòng điền mã đơn vị',
            'website.unique'  =>  'Địa chỉ website đã được sử dụng!',
            'website.required'  =>  'Vui lòng điền địa chỉ website'
        ];
    }
}
