<?php

namespace Rezyon\Applications\Companies\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;

class CompanyOfficialUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $phoneValid = [
            'phone',
            Rule::unique('company_officials')
                ->where(function ($query) {
                    return $query->whereNot('id', request()->id);
                })
        ];
        return [
            'id' => 'required|integer|exists:company_officials,id',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email:rfc,dns,filter',
            'title' => 'required|max:255',
            'phone_country' => 'required_with:phone|alpha', // ENUM gelecek,
            'phone' => $phoneValid,
        ];
    }

    protected function prepareForValidation()
    {
        $id = $this->route('id');
        $service = app(CompaniesServiceInterface::class);
        $official = $service->officialFind($id);

        $arr = [
            'id' => $id,
            'phone' => $official->phone
        ];

        if (request()->post('phone') != $official->phone) {
            $arr['phone'] = request()->post('phone');
        }

        $this->merge($arr);
    }

}
