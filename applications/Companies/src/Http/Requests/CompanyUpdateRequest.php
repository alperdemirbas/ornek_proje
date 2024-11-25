<?php

namespace Rezyon\Applications\Companies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;

class CompanyUpdateRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email','email:rfc,dns'],
            'description' => ['required'],
            'address' => ['required'],
            'phone_country' => ['required','string'],
            'phone' => ['required', 'numeric'],
            'payment_frequency' => ['required', new Enum(PaymentFrequencyEnums::class)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Zorunlu alan'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }
}
