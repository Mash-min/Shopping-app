<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateValidation extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'srp' => 'required|numeric',
            'quantity' => 'required|numeric',
            'warranty' => 'required|numeric',
            'delivery_fee' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'price.required' => 'Product price is required',
            'discount.numeric' => 'Product discount should be a number',
            'srp.required' => 'Product srp is required',
            'quantity.required' => 'Product quantity is required',
            'warranty.required' => 'Product warranty is required',
            'delivery_fee.required' => 'Product delivery fee is required',
            'image.mimes' => 'Invalid image format',
        ];
    }
}
