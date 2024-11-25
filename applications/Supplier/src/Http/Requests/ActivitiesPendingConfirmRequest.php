<?php

namespace Rezyon\Applications\Supplier\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Rezyon\Applications\Supplier\Enums\AdminPermissionsEnum;
use Rezyon\Supplier\Enums\ActivityStatusEnum;

class ActivitiesPendingConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (Auth::guard('web')->user()->can(AdminPermissionsEnum::ADMIN_ACTIVITY_PENDING_CONFIRM->value));
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
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
