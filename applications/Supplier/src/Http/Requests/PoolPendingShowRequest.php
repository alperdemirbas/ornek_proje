<?php

namespace Rezyon\Applications\Supplier\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Rezyon\TourismCompany\Enums\ActivityStatus;

class PoolPendingShowRequest extends FormRequest
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
            'id' => 'required|exists:tourism_company_activities,id,status,'.ActivityStatus::WAITING_APPROVE->value,
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
