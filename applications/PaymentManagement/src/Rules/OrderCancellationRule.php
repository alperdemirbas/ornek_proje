<?php

namespace Rezyon\Applications\PaymentManagement\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Rezyon\Carts\Models\Carts;

class OrderCancellationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $now = Carbon::now();
        $cart = Carts::where('id', $value)
            ->whereNotNull('orders_id')
            ->where('status', true)
            ->where('users_id', request()->user()->id)
            ->first();
        if(!$cart) {
            $fail('Item is invalid.');
        }
        if($cart->cancelled) {
            $fail('Item already cancelled.');
        }
        if ($cart->order->created_at->lt($now->subDays(15))) {
            $fail('The order date must not exceed 15 days.');
        }
        if($cart->session) {
            $session = $cart->session;
            $sessionTime = Carbon::parse($session->start_time)->format('H:i:s');
            $selectedDate = Carbon::parse($cart->selected_time)->format('Y-m-d');
            $startTime = Carbon::parse("{$selectedDate} {$sessionTime}");
            $twoHoursBeforeStartTime = $startTime->copy()->subHours(2);
            if ($now->gt($twoHoursBeforeStartTime)) {
                $fail('Expected two hours before');
            }
        } else {
            $selectedDate = Carbon::parse($cart->selected_time)->format('Y-m-d');
            $activityStartTime = Carbon::parse($cart->activity->start_time)->format('H:i:s');
            $startTime = Carbon::parse("{$selectedDate} {$activityStartTime}");
            $twoHoursBeforeStartTime = $startTime->copy()->subHours(2);
            if ($now->gt($twoHoursBeforeStartTime)) {
                $fail('Expected two hours before');
            }
        }
    }
}
