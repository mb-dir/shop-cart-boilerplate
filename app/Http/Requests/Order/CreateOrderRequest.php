<?php

namespace App\Http\Requests\Order;


use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city' => ['required', 'string', 'min:3'],
            'main_street' => ['required', 'string', 'min:3'],
            'house_number' => ['required', 'string'],
            'phone' => ['required', 'regex:/^[0-9\s\-+()]*$/'],
            'payment_type_id' => ['required', 'integer', 'exists:payment_types,id'],
            'delivery_type_id' => ['required', 'integer', 'exists:delivery_types,id'],
        ];
    }
}
