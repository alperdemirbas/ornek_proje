<?php

namespace Rezyon\Applications\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Users\Enums\Gender;

class EndUserAStoreRequest extends FormRequest
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
            'gender.*' => ['required',new Enum(Gender::class)],
            'birthdate.*' => ['required'],
            'email.*' => 'required|email|unique:users,email,NULL,id,companies_id,' . $this->input('id'),
        ];
    }

    public function messages()
    {
        return [
            'gender.required'=>'cinsiyet zorunlu',
            'gender.enum' => 'seçenek olacak',
            'birthDate.date_format'=>'bu format olmaz',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user'=>$this->request->all()
        ]);
    }
}
