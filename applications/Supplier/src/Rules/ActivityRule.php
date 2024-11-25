<?php

namespace Rezyon\Applications\Supplier\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Rezyon\Supplier\Enums\ActivityStatusEnum;
use Rezyon\Supplier\Models\Activity;

class ActivityRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $activity = Activity::where('id', $value)
            ->where(function ($query) {
                $query->where('status', ActivityStatusEnum::ACTIVE)
                    ->orWhere(function ($query) {
                        $query->where('companies_id', auth()->user()->companies_id)
                            ->where('status', '!=', ActivityStatusEnum::ACTIVE);
                    });
            })
            ->exists();

        if(!$activity) {
            $fail('validation.exists')->translate(['attribute' => 'id']);
        }
    }
}
