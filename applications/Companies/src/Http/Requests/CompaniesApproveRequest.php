<?php

namespace Rezyon\Applications\Companies\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Rezyon\Companies\Interfaces\CompanyPackagesRepositoryInterface;

class CompaniesApproveRequest extends FormRequest
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
        return [
            'domain'=> 'unique:companies,domain',
            'company_id' => 'required|exists:companies,id,is_active,0,verify_at,NULL,domain,NULL|exists:companies_packages,companies_id,start_date,NULL',
        ];
    }


}
