<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class indexProductRequest extends FormRequest
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
            'filterName' => 'bail|nullable|min:3|max:80',
            'filterPriceMin' => 'bail|nullable|min:3|max:80',
            'filterPriceMax' => 'bail|nullable|min:3|max:80',
            'filterCategory' => 'bail|nullable|exists:categories,id',
        ];
    }
}
