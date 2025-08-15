<?php

namespace App\Base\Entities\Enums;

use Illuminate\Validation\Rules\Enum;


class UrlEnum extends Enum
{
    public static function API(): string
    {
        return "http://127.0.0.1:8000";
    }

    public static function APP(): string
    {
        return env('APP');
    }


    public static function AF(): string
    {
        return env('AF').'/api/v1/';
    }

    // public static function QUICK_PAY_WEB(): string
    // {
    //     return self::APP().'/order/quick-pay/';
    // }

    public static function PANEL(): string
    {
        return self::APP().'/panel/';
    }

    public static function CALL_BACK(): string
    {
        return self::API().'/order/callback/';
    }

    public static function ZARIN_PAL_TOKEN(): string
    {
        return env('ZARIN_PAL_TOKEN');
    }

    const ZARIN_PAL_GATEWAY = 'https://api.zarinpal.com';

    const ZARIN_PAL_ACCEPT = 'https://www.zarinpal.com/pg/StartPay/';

    const MELI_PAYAMAK = 'https://console.melipayamak.com/api/send/simple';



    public static function MELI_PAYAMAK_KEY(): string
    {
        return env('MELI_PAYAMAK_KEY');
    }

    public static function MELI_PAYAMAk_PHONE_NUMBER(): string
    {
        return env('MELI_PAYAMAk_PHONE_NUMBER');
    }


    public static function CHECK_OUT(): string
    {
        return self::APP().'/order/checkout/';
    }

    const CODE_OPDER="LOCKITO-";


}
