<?php

namespace Rezyon\Applications\Supplier\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\Supplier\Enums\PermissionsEnum;
use Rezyon\TourismCompany\Enums\ActivityStatus;

class ActivityPoolPendingApproveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (Auth::guard('companies')->user()->can(PermissionsEnum::SUPPLIER_ACTIVITY_POOL_PENDING_APPROVE->value));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:tourism_company_activities,id,status,' . ActivityStatus::WAITING_APPROVE->value,
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
