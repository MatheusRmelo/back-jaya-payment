<?php

namespace App\Http\Requests;

use App\Enums\IdentificationType;
use App\Enums\PaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentSaveRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'transaction_amount' => 'required|numeric',
            'installments' => 'required|integer',
            'token' => 'required|string',
            'payment_method_id' => 'required|string',
            'status' => [
                'required',
                'string',
                Rule::in(PaymentStatus::VALUES)
            ],
            'payer' => 'required',
            'payer.email' => 'required|email',
            'payer.identification.type' => [
                'required',
                'string',
                Rule::in(IdentificationType::VALUES)
            ],
            'payer.identification.number' => 'required|numeric'

        ];
    }
}
