<?php

namespace Rezyon\Applications\TourismCompany\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum;

class TourismActivityAddCloseDayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (Auth::user()->can(PermissionsEnum::TOURISM_ACTIVITY_UPDATE->value));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'closed_days.*.tourism_activity_id' => 'required|integer|exists:tourism_company_activities,id,companies_id,'.$this->user()->company->id,
            'closed_days.*.start_date' => 'required|date',
            'closed_days.*.end_date' => 'required|date',
        ];
    }
}
