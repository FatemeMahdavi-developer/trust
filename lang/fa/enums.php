<?php

use App\Base\Entities\Enums\BoxState;
use App\Base\Entities\Enums\BasketState;
use App\Base\Entities\Enums\OrderType;
use App\Base\Entities\Enums\PaymentType;
use App\Base\Entities\Enums\SizeLocker;

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
    ],
    PaymentType::class => [
        PaymentType::PENDING->name => 'در انتظار',
        PaymentType::SUCCESS->name => 'موفق',
        PaymentType::FAILED->name => 'ناموفق',
        PaymentType::REVERSE->name => 'بازگشت داده شد',
    ],
    SizeLocker::class=>[
        SizeLocker::BIG->name=>"بزرگ",
        SizeLocker::MIDDLE->name=>"متوسط",
        SizeLocker::SMALL->name=>"کوچک"
    ]
];
