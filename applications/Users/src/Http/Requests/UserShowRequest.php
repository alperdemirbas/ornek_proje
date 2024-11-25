<?php

namespace Rezyon\Applications\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Rezyon\Users\Enums\Types;

class UserShowRequest extends FormRequest
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
            'id'=>'required|exists:users,id,type,'.Types::ADMIN->value
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id'=>$this->route('id')]);
    }
}
