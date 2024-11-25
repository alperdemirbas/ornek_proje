<?php

namespace Rezyon\Applications\PaymentManagement\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum;

class ActivityPoolUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (Auth::guard('companies')->user()->can(PermissionsEnum::TOURISM_ACTIVITY_UPDATE->value));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:tourism_company_activities',
            'profitability' => 'required|numeric',
            'special_days' => 'array',
            'special_days.*.start_date' => 'required|date',
            'special_days.*.end_date' => 'required|date',
            'special_days.*.profitability' => 'required|numeric',
            'special_days.*.activity_id' => 'required|integer|exists:activities,id',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(['id' => $this->route('id')]);
    }
}
