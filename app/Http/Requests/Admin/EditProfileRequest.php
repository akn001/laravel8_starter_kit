<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'password' =>'required',
            'cpassword' =>'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required'=>'This field is required.',
            'cpassword.required' => 'This field is required.',
            'cpassword.same' => 'Please Enter same password.'
        ];
    }
}
