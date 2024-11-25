<?php

namespace Rezyon\Companies\Enums;

enum PaymentFrequencyEnums : string
{
    case MONTHLY = 'MONTHLY';
    case QUARTER = 'QUARTER';
    case HALF_YEARLY = "HALF_YEARLY";
    case YEARLY = "YEARLY";
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function valueFromString(string $name): self
    {
        return constant("self::$name");
    }

}
