<?php

namespace Rezyon\Applications\Hotel\Http\Requests\Assignments;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AssignmentDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return ($this->user()->id == $this->user_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'user_id' => 'required|exists:users,id',
            'id' => ['required', Rule::exists('user_of_hotel')->whereNull('deleted_at')],
        ];
    }

    public function messages()
    {
        return [
            "user_id.required" => "Bir hata oluştu lütfen sayfayı yenileyin.",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id
        ]);
    }
}
