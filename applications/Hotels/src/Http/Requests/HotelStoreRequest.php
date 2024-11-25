<?php

namespace Rezyon\Applications\Hotels\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Hotels\Enums\StatusEnum;

/**
 *
 */
class HotelStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone_country' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'status' => ['required', new Enum(StatusEnum::class)],
            'city' => 'required|integer|exists:cities,id',
            'district' => 'required|integer|exists:districts,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => str_replace([' ', '(', ')', '-'], '', $this->phone),
        ]);
    }
}
