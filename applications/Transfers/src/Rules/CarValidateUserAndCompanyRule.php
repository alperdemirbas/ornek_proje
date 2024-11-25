<?php

namespace Rezyon\Applications\Transfers\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Rezyon\Transfers\Models\Cars;

class CarValidateUserAndCompanyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Cars::where('id', $value)->with('user', function ($query) {
            $query->where('companies_id', request()->user()->companies_id);
        })->first();
        if(!$query) {
            $fail('Araç Bulunamadı.');
        }
    }
}
