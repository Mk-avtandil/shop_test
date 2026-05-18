<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'in:pending,processing,shipped,delivered,cancelled'],
        ];
    }
}
