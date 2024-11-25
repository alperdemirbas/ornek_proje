<?php

namespace Rezyon\Applications\Tickets\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Rezyon\Tickets\Models\Tickets;

class TicketValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currentDate = Carbon::now();
        if(gettype($value) === "string") {
            $ticket = Tickets::where('code', $value)
                ->where('start_time', '>=', $currentDate)
                ->where([
                    'used_at' => null,
                    'owner_id' => null,
                    'approved_by' => null
                ])
                ->exists();
            if(!$ticket) {
                $fail('Ticket is invalid.');
            }
        } else {
            $ticket = Tickets::where('id', $value)
                ->where('start_time', '>=', $currentDate)
                ->where([
                    'used_at' => null,
                    'owner_id' => null,
                    'approved_by' => null
                ])
                ->exists();
            if(!$ticket) {
                $fail('Ticket is invalid.');
            }
        }
    }
}
