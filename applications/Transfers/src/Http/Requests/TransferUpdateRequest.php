<?php

namespace Rezyon\Applications\Transfers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Rezyon\Applications\Transfers\Rules\TransferValidityCarRule;
use Rezyon\TourismCompany\Enums\ActivityStatus;

class TransferUpdateRequest extends FormRequest
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
            'id' => 'required|integer|exists:transfers,id',
            'hotel_id' => 'required|integer|exists:hotels,id,status,1',
            'cars_id' => ['required', 'integer', new TransferValidityCarRule],
            'start_date' => 'required|date',
            'driver_name' => 'required|string',
            'driver_phone' => 'required|string',
            'driver_phone_country' => 'required|string'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('transfer')
        ]);
    }
}
