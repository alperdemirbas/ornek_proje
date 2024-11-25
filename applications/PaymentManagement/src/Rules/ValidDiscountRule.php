<?php

namespace Rezyon\Applications\PaymentManagement\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Rezyon\Discounts\Models\Discounts;
use Rezyon\Discounts\Models\UserDiscounts;

class ValidDiscountRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $discount = Discounts::where('code', $value)
            ->with('userDiscount')
            ->where('validity_date', '>', Carbon::now())
            ->first();

        $hasUsed = UserDiscounts::where('discounts_id', $discount->id ?? null)
            ->whereNotNull('used_at')
            ->where('users_id', request()->user()->id)
            ->exists();

        if(!$discount) {
            $fail('Coupon code is invalid.');
        } else if($discount->userDiscount->count() >= $discount->max_using) {
            $fail('This coupon code is sold out.');
        } else if($hasUsed) {
            $fail('This coupon code has already been used.');
        }
    }
}
