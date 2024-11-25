<?php

namespace Rezyon\Applications\Packages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Packages\Enums\PackageTypesEnums;

class PackageStoreRequest extends FormRequest
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
            'package_name' => 'required|string',
            'package_type' => ['required',new Enum(PackageTypesEnums::class)],
            'sale_price'=>'required|min:1',
            'quarter_yearly_discount'=>'required',
            'half_yearly_discount'=>'required',
            'yearly_discount'=>'required'
        ];
    }
}
