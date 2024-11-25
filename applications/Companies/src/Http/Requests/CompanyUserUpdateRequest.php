<?php

namespace Rezyon\Applications\Companies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum;
use Rezyon\Users\Enums\Types;

class CompanyUserUpdateRequest extends FormRequest
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
            'id' => 'required|integer|exists:users,id,companies_id,' . $this->user()->company->id,
            'firstname' => 'required|string|max:32|min:3',
            'lastname' => 'required|string|max:32|min:2',
            'email' => 'required|email:rfc,dns',
            'permissions' => 'array',
            'permissions.*' => 'string'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('user'),
        ]);
        /**
         * permissions değerleri switch inputtan dolayi "on" geliyor. Burda sadece key'i aliyoruz.
         */
        if ($this->permissions !== null) {
            $permissions = [];
            foreach ($this->permissions as $key => $value) {
                $permissions[] = $key;
            }
            $this->merge([
                'permissions' => $permissions
            ]);
        }
    }
}
