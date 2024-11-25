<?php

namespace Rezyon\Applications\Tickets\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Rezyon\Applications\Tickets\Rules\TicketValidationRule;

class OwnTicketRequest extends FormRequest
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
            'id' => ['required', 'integer', new TicketValidationRule],
            'user_id' => 'required|integer|exists:users,id,companies_id,'.request()->user()->companies_id
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => (int) $this->route('ticket')
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
