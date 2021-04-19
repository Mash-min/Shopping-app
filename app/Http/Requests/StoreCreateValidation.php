<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreateValidation extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'unique:stores,user_id',
            'name' => 'required|unique:stores,name',
            'email' => 'required|unique:stores,email',
            'address' => 'required',
            'contact' => 'required|unique:stores,contact',
            'description' => 'required'
        ];
    }
}
