<?php

namespace Rezyon\Applications\Companies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Rezyon\Companies\Enums\PaymentStatusesEnums;

class CompanyDemoShowRequest extends FormRequest
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
            'id' => 'required|exists:companies,id,verify_at,NULL,domain,NULL|exists:companies_packages,companies_id,payment_status,' . PaymentStatusesEnums::WAITING_VERIFICATION->value,
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge(
            ['id' => $this->route('id')]
        );
    }
}
