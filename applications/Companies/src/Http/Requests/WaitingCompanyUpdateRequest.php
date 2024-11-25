<?php

namespace Rezyon\Applications\Companies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Rezyon\Companies\Enums\PaymentStatusesEnums;

class WaitingCompanyUpdateRequest extends FormRequest
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
            'id' => 'required|exists:companies,id,verify_at,NULL,domain,NULL|exists:companies_packages,companies_id,payment_status,'.PaymentStatusesEnums::WAITING_VERIFICATION->value,
            'name'=> 'required',
            'email' =>'required|email',
            'description' => 'nullable',
            'address' => 'required',
            'phone' => 'required|phone',
            'phone_country' => 'required_with:phone',
            'files' => 'nullable|array|max:5',
            'files.*' => 'mimes:pdf',
            'official_first_name' => 'required',
            'official_last_name' => 'required',
            'official_email' =>'required|email',
            'official_title' => 'nullable',
            'official_phone' => 'required|phone',
            'official_phone_country' => 'required_with:phone',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }
}
