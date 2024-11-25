<?php

namespace Rezyon\Applications\PaymentManagement\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Rezyon\Orders\Enums\PaymentTypeEnum;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;

class OrderWebhookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'merchant_oid' => 'required|string|exists:orders,merchant_oid',
            'status' => 'required|string',
            'total_amount' => 'required|numeric',
            'hash' => 'required|string',
            'failed_reason_code' => 'nullable|integer',
            'failed_reason_msg' => 'nullable|string',
            'test_mode' => 'nullable|boolean',
            'payment_type' => ['required', Rule::enum(PaymentTypeEnum::class)],
            'currency' => ['nullable', Rule::enum(CurrencyEnums::class)],
            'payment_amount' => 'nullable|numeric'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
