<?php

namespace Rezyon\Supplier\Enums;

enum ActivityStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case REJECTED = 'rejected';
    case WAITING = 'waiting';

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function valueFromString(string $name)
    {
        return constant("self::$name");
    }
}
