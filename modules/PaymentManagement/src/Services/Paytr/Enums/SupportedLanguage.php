<?php

namespace Rezyon\PaymentManagement\Services\Paytr\Enums;

enum SupportedLanguage: string
{

    case TR = 'tr';
    case EN = 'en';

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
