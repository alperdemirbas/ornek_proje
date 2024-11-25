<?php

namespace Rezyon\Applications\Carts\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartUpdateRequest extends FormRequest
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
            'id' => 'required|integer|exists:carts,id,users_id,'.$this->user()->id,
            'selected_time' => 'required|date',
            'activity_session_id' => 'nullable|integer|exists:activity_sessions,id',
            'adult' => 'required_without:child,baby|integer',
            'child' => 'required_without:adult,baby|integer',
            'baby' => 'required_without:adult,child|integer'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('cart')
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
