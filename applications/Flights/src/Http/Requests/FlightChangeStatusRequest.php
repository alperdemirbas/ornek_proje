<?php

namespace Rezyon\Applications\Flights\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Applications\Flights\Enums\StatusEnums;

class FlightChangeStatusRequest extends FormRequest
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
            "row" => ["required", Rule::exists('flights', 'id')],
            "uid" => "required",
            "uid.*" => ["required", Rule::exists('users', 'id')],
            "role" => ["required", new Enum(StatusEnums::class)],
        ];
    }
}
