<?php

namespace Rezyon\Applications\Packages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageShowRequest extends FormRequest
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
            'id'=>'required|exists:packages,id'
        ];
    }

    protected function prepareForValidation()
    {
        $id = $this->route('id');
        $this->merge(['id'=>$id]);
    }

}
