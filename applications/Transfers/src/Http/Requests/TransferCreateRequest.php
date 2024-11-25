<?php

namespace Rezyon\Applications\Transfers\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Rezyon\Applications\Transfers\Rules\TransferValidityCarRule;
use Rezyon\TourismCompany\Enums\ActivityStatus;

class TransferCreateRequest extends FormRequest
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
            'activity_id' => 'required|integer|exists:tourism_company_activities,activity_id,companies_id,'.$this->user()->companies_id.',status,'.ActivityStatus::ACTIVE->value,
            'hotel_id' => 'required|integer|exists:hotels,id,status,1',
            'activity_session_id' => 'required|integer|exists:activity_sessions,id,activity_id,'.$this->post('activity_id'),
            'cars_id' => ['required', 'integer', new TransferValidityCarRule],
            'date' => 'required|date|exists:carts,selected_time,status,1,activity_id,'.$this->activity_id,
            'time' => 'required|date',
            'driver_name' => 'required|string',
            'driver_phone' => 'required|string',
            'driver_phone_country' => 'required|string'
        ];
    }

    protected function prepareForValidation()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $dateTime = Carbon::createFromFormat('Y-m-d H:i', $currentDate . ' ' . $this->time);
        $this->merge([
            'time' => $dateTime->format('Y-m-d H:i:s')
        ]);
    }
}
