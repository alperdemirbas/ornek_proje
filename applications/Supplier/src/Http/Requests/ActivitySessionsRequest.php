<?php

namespace Rezyon\Applications\Supplier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Rezyon\Supplier\Enums\ActivityStatusEnum;

class ActivitySessionsRequest extends FormRequest
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
            'activity_id' => 'required|integer|exists:activities,id,status,'.ActivityStatusEnum::ACTIVE->value
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'activity_id' => $this->route('activity')
        ]);
    }
}
