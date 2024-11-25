<?php

namespace Rezyon\Applications\Supplier\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\Supplier\Enums\AdminPermissionsEnum;
use Rezyon\Supplier\Enums\ActivityStatusEnum;

class ActivitiesPendingRejectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (Auth::guard('web')->user()->can(AdminPermissionsEnum::ADMIN_ACTIVITY_PENDING_REJECT->value));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:activities,id,status,'.ActivityStatusEnum::WAITING->value,
            'rejected_reason' => 'required|string|max:64',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
