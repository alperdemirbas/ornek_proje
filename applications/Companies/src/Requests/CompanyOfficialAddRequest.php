<?php

namespace Rezyon\Applications\Companies\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyOfficialAddRequest extends FormRequest
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
            'companies_id' => 'required|numeric|exists:companies,id',
            'title' => 'required|string',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|email|unique:company_officials,email',
            'phone' => 'required|phone',
            'phone_country' => 'required_with:phone|alpha',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'companies_id' => $this->route('id')],
        );
    }
}
