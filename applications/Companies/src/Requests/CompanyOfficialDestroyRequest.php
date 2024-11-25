<?php

namespace Rezyon\Applications\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\Companies\Enums\AdminPermissionsEnum;

class CompanyOfficialDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (Auth::user()->can(AdminPermissionsEnum::ADMIN_OFFICIALS_DELETE->value));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'official_id'=>'required'
        ];
    }

}