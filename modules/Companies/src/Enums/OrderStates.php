<?php

namespace Rezyon\Companies\Enums;

enum OrderStates : string
{
    case CREATED = 'CREATED';
    case WAITING_RESPONSE = 'WAITING_RESPONSE';
    case SUCCESS = 'SUCCESS';
    case FAILED = 'FAILED';
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function valueFromString(string $name): self
    {
        return constant("self::$name");
    }

}
