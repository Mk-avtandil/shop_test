<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'name' => ['string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['numeric', 'min:0'],
            'stock' => ['integer', 'min:0'],
        ];
    }
}
