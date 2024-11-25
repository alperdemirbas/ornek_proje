<?php

namespace Rezyon\Applications\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6|max:16',
            'domain' => 'required|exists:companies,domain,is_active,1'
        ];
    }
    protected function prepareForValidation()
    {
        return $this->merge([
           'domain' => $this->subdomain
        ]);
    }
}
