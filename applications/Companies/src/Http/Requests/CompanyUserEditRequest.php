<?php

namespace Rezyon\Applications\Companies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\Companies\Enums\CompanyPermissionsEnum;
use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum;
use Rezyon\Users\Enums\Types;

class CompanyUserEditRequest extends FormRequest
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
            'id' => 'required|integer|exists:users,id,companies_id,'.$this->user()->company->id,
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('user'),
        ]);
    }
}
