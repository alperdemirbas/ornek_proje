<?php

use App\Enums\ElementTypeEnum;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use libphonenumber\PhoneNumberUtil;

if (!function_exists('_route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param string $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function _route(string $name, array $parameters = [], bool $absolute = true): string
    {
        $parameters['subdomain'] = Route::getCurrentRoute()->subdomain;
        return app('url')->route($name, $parameters, $absolute);
    }
}

if(!function_exists('camelToSnake')){
    function camelToSnake( string $input): string
    {
        $pattern = '/(?<=\w)(?=[A-Z])|(?<=[a-z])(?=\d)/';
        $replacement = '_$1';
        return strtolower(preg_replace($pattern, $replacement, $input));
    }
}

if( !function_exists('phone_supported_regions')){
    /**
     * @return array
     */
    function  phone_supported_regions(): array
    {
        return array_map('strtoupper', PhoneNumberUtil::getInstance()->getSupportedRegions());
    }
}

if (!function_exists('generateUsername')) {
    /**
     * @param $fullname
     * @return string
     */
    function generateUsername($fullname): string
    {
        $username = strtolower(str_replace(' ', '', $fullname));
        $username = substr(iconv('UTF-8', 'ASCII//TRANSLIT', $username), 0, 6);
        do {
            $randomNumber = rand(100, 999);
            $generatedUsername = $username . $randomNumber;
            $existingUser = User::where('username', '=', $generatedUsername)->first();
        } while ($existingUser);
        return $generatedUsername;
    }
}

if (!function_exists('generateRandomPassword')) {
    /**
     * @param int $length
     * @return string
     */
    function generateRandomPassword(int $length = 12): string
    {
        // Şifre karakterlerini tanımlayın
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+[]{}|';

        // Karakter dizisini karıştırın
        $charactersLength = strlen($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, $charactersLength - 1);
            $password .= $characters[$randomIndex];
        }

        return $password;
    }
}

if (!function_exists('convertSubdomain')) {
    /**
     * @param $name
     * @return string
     */
    function convertSubdomain($name): string
    {
        return substr(preg_replace("/[^a-z0-9]/", "", strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $name))), 0, 10) . '.rezyon.com';
    }
    /**
     * @param float $price
     * @return string
     */
    function price(float $price): string
    {
        return number_format($price, 2, '.', ',');
    }

}

if (!function_exists('generateUniqueCode')) {
    function generateUniqueCode($model=null,$length = 5)
    {
        $characters = 'ABCDEFGHJKLMNPRSTXYZ2345679';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Eğer model adı girmezsek Users::model sorgulama yapmaz.
        if (isset($model)) {
            while ($model::where('pnr', $code)->exists()) {
                $code = '';
                for ($i = 0; $i < $length; $i++) {
                    $code .= $characters[rand(0, strlen($characters) - 1)];
                }
            }
        }

        return $code;
    }
}

if(!function_exists('generateMerchantOID')) {
    function generateMerchantOID()
    {
        return strtoupper(uniqid("RZ"));
    }
}

if(!function_exists('generateReferenceNo')) {
    function generateReferenceNo()
    {
        return strtoupper(uniqid());
    }
}

if(!function_exists('makeOrderHash')) {
    function makeOrderHash($merchant_oid, $merchant_salt, $status, $total_amount, $merchant_key)
    {
        return base64_encode( hash_hmac('sha256', $merchant_oid.$merchant_salt.$status.$total_amount, $merchant_key, true) );
    }
}

if(!function_exists('generateTicketCode')) {
    function generateTicketCode()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $length = 12;
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomCode;
    }
}

if(!function_exists('merge')) {
    function merge(...$args)
    {
        $separator = ' ';
        if (count($args) > 0 && is_string($args[0]) && strlen($args[0]) == 1) {
            $separator = array_shift($args);
        }
        return implode($separator, $args);
    }
}

if(!function_exists('buttonGenerator')) {
    function buttonGenerator(ElementTypeEnum $element,string $type = null, string $href = null, string $class, array $attributes = [], string $icon = null,string $text)
    {
        if($element === ElementTypeEnum::BUTTON) {
            return [
                "element" => $element->value,
                "type" => $type,
                "class" => $class,
                "attributes" => $attributes,
                "icon" => $icon,
                "text" => $text
            ];
        }
        return [
            "element" => $element->value,
            "href" => $href,
            "class" => $class,
            "attributes" => $attributes,
            "icon" => $icon,
            "text" => $text
        ];

    }
}

if(!function_exists('phoneFormat')) {
    function phoneFormat(string $phone, string $phoneCountry)
    {
        if($phoneCountry === "TR") {
            return '+90 (' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . ' ' . substr($phone, 6);
        }
        return phone($phone, $phoneCountry)->formatE164();
    }
}


