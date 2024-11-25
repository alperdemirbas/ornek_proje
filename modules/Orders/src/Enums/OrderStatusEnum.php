<?php

namespace Rezyon\Orders\Enums;

enum OrderStatusEnum:string
{
    case FAILED = "failed"; //ödeme hata verdi
    case COMPLETED = "completed"; //ödeme tamamlandı
    case INCOMPLETE = "incomplete"; //ödeme tamamlanmadı
    case PENDING = "pending"; //ödemenin tamamlanması bekleniyor
    case CANCELLED = "cancelled"; //iptal edildi
    case RETURNED = "returned"; //iade edildi

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values():array
    {
        return array_column(self::cases(),'value');
    }
}
