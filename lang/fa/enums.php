<?php

use App\base\Entities\Enums\BoxState;
use App\base\Entities\Enums\BasketState;
use App\base\Entities\Enums\OrderType;

return [
    BoxState::class => [
        BoxState::EMPTY->name => 'خالی',
        BoxState::FILL->name => 'پر',
        BoxState::RESERVED->name => 'رزرو شده',
    ],
    BasketState::class => [
        BasketState::REGISTRATION->name => 'ثبت',
        BasketState::PREPARATION->name => 'اماده سازی',
        BasketState::CANCEL->name => 'کنسل',
    ],
    OrderType::class => [
        // OrderType::ONLINE_PAYMENT->name => 'پرداخت آنلاین',
        OrderType::BANK_FISH->name => 'فیش بانکی',
    ]
];
