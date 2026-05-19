<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'status' => ['required', 'string', 'in:pending,processing,shipped,delivered,cancelled'],
            'products' => ['required', 'array'],
        ];
    }
}
