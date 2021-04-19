<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateValidation extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users,email',
            'contact' => 'required|unique:users,contact',
            'address' => 'required',
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Firstname field is required!',
            'lastname.required' => 'Lastname field is required',
            'email.required' => 'Email field is required',
            'email.unique' => 'Email is already taken',
            'contact.required' => 'Contact field is required',
            'contact.unique' => 'Contact is already taken',
            'address.required' => 'Address field is required',
            'password.required' => 'Password field is required'
        ];
    }
}
