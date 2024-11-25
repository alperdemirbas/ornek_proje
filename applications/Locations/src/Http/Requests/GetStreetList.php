<?php

namespace Rezyon\Applications\Locations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetStreetList extends FormRequest
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
            'neighborhood_id'=>'required|exists:neighborhoods,id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['neighborhood_id' => $this->route('neighborhood_id')]);
    }
}
