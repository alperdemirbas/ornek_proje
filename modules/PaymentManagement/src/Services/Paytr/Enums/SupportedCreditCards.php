<?php

namespace Rezyon\PaymentManagement\Services\Paytr\Enums;

enum SupportedCreditCards:string{

    CASE ADVANTAGE = 'ADVANTAGE';
    CASE AXESS = 'AXESS';
    CASE COMBO = 'COMBO';
    CASE BONUS = 'BONUS';
    CASE CARD_FINANS = 'CARD FINANS';
    CASE MAXIMUM = 'MAXIMUM';
    CASE PARAF = 'PARAF';
    CASE WORLD = 'WORLD';
    CASE SAGLAM_KART = 'SAGLAM KART';

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
