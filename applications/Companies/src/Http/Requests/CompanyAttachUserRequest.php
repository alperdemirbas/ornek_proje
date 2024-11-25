<?php

namespace Rezyon\Applications\Companies\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CompanyAttachUserRequest extends FormRequest
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
            'id' => 'required|exists:companies,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,companies_id,' . $this->input('id'),
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(['id' => $this->route('id')]);
    }

}
