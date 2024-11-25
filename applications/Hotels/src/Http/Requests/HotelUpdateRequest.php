<?php

namespace Rezyon\Applications\Hotels\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Hotels\Enums\StatusEnum;

class HotelUpdateRequest extends FormRequest
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
            'id' => 'required|integer|exists:hotels,id',
            'name' => 'required|string',
            'phone_country' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'status' => ['required', new Enum(StatusEnum::class)],
            'city_id' => 'required|integer|exists:cities,id',
            'district_id' => 'required|integer|exists:districts,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('hotel'),
            'phone' => str_replace([' ', '(', ')', '-'], '', $this->phone),
        ]);
    }
}
