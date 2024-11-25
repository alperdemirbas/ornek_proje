<?php

namespace Rezyon\Applications\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Rezyon\Users\Enums\Types;

class CompanyOfficialEditRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'official_id'=>'required|exists:company_officials,id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'official_id'=>$this->route('id')
        ]);
    }
}
