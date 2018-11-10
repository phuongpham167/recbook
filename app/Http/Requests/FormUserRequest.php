<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormUserRequest extends FormRequest
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
            'email' =>   [
                'required',
                'email',
                Rule::unique('users')->ignore(request('id')),
            ],
            'password'  =>  'required',
            'group_id'  =>  'required',
            'branch_id' =>  'required'
        ];
    }
}
