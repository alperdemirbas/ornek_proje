<?php

namespace Rezyon\Applications\TourismCompanyUser\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;
use Rezyon\Users\Enums\Types;

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
            'username' => 'required|exists:users,username,type,'.Types::CUSTOMER->value,
            'password' => 'required|min:6|max:16',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
