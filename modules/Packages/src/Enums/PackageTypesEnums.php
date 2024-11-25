<?php

namespace Rezyon\Packages\Enums;

enum PackageTypesEnums: string
{
    case SUPPLIER = 'SUPPLIER';
    case TOURISM_COMPANY = 'TOURISM_COMPANY';
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function valueFromString(string $name): self
    {
        return constant("self::$name");
    }
}
