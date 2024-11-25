<?php

namespace Rezyon\Applications\Tickets\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Rezyon\Tickets\Models\Tickets;

class TicketReadRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ticket = Tickets::where('id', $value)
            ->whereNotNull('owner_id')
            ->whereNull('used_at')
            ->whereNull('approved_by')
            ->exists();

        if(!$ticket) {
            $fail('Ticket is not found.');
        }

    }
}
