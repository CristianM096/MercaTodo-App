<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|between:0,99999999.99',
            'photo' => 'nullable|image|max:255',
            'description' => 'string|max:100',
            'stock' => 'between:0,9999999|nullable',
            'color' => 'required|string|max:100',
            'weight' => 'required|between:0,9999.99',
            'size' => 'string|max:100',
            'active' => 'required|boolean'
        ];
    }
}
