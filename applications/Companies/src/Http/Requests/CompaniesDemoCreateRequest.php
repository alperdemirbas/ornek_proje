<?php

namespace Rezyon\Applications\Companies\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Companies\Enums\PaymentFrequencyEnums;

class CompaniesDemoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /**
         * @todo Buraya limit eklenicek
         */
        return [
            'name'=> 'required',
            'email' =>'required|email',
            'description' => 'nullable',
            'address' => 'required',
            'phone' => 'required|phone',
            'phone_country' => 'required_with:phone',
            'files' => 'required|array|max:5',
            'files.*' => 'mimes:pdf',
            'official_first_name' => 'required',
            'official_last_name' => 'required',
            'official_email' =>'required|email',
            'official_title' => 'nullable',
            'official_phone' => 'required|phone',
            'official_phone_country' => 'required_with:phone',
            'type' => ['required',new Enum(CompanyTypeEnums::class)],
            'package_id' => 'required|exists:packages,id,type,'.$this->type,
            'payment_frequency' => ['required',new Enum(PaymentFrequencyEnums::class)]
        ];
    }
}
