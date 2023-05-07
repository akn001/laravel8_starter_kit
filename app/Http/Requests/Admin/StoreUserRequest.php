<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreUserRequest extends FormRequest
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
    {//dd($this->id);
        return [
            'name' =>'required',
            'email' =>['email','required',Rule::unique('users')->ignore($this->id)],
            'mobile' =>'numeric',
            'username' =>['required',Rule::unique('users')->ignore($this->id)]
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'This field is required.',
            'mobile.numeric' => 'This field must be numeric.',
            'email.email' => 'Please Enter valid Email ID.',
            'email.unique' => 'Email Id already exist.',
            'email.required'=>'This field is required.',
            'username.required' => 'This field is required.',
            'username.unique' => 'Username already exist.'
        ];
    }
}
