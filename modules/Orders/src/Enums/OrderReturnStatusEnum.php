<?php

namespace Rezyon\Orders\Enums;

enum OrderReturnStatusEnum:string
{
    case SUCCESS = "success"; //başarılı
    case ERROR = "error"; //hatalı
    case PENDING = "pending"; //bekleniyor

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values():array
    {
        return array_column(self::cases(),'value');
    }
}
