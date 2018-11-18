<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
        $rules =  [
            'name'  =>  'required',
            'email' =>   [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->user()->id),
            ],
//            'group_id'  =>  'required',
//            'branch_id' =>  'required'
        ];
        return $rules;
    }
}
