<?php

namespace Rezyon\Applications\Flights\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FlightStatusRequest extends FormRequest
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
            'flight' => ['required', 'integer', Rule::exists('flights', 'id')->where(function ($query) {
                $query->where('status', '!=', 'cancelled')
                    ->where('status', '!=', 'returned');
            })],
            'role' => 'required|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'flight' => $this->route('flight'),
        ]);
    }
}
