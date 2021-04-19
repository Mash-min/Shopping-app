<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateValidation extends FormRequest
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
    
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'contact' => 'required|numeric',
            'description' => 'required'
        ];
    }

    public function messasges()
    {
        return [
            'name.required' => 'Store name is required',
            'name.unique'   => 'Store name is already taken',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already taken',
            'address.required' => 'Address is required',
            'contact.required' => 'Contact is required',
            'contact.numeral' => 'Invalid contact',
            'contact.unique' => 'Contact is already taken',
        ];
    }
    
}
