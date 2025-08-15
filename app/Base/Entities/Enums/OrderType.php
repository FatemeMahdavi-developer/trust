<?php

namespace App\Base\Entities\Enums;

enum OrderType: string
{
    case ONLINE_PAYMENT = 'online';
    case BANK_FISH = 'fish';
}

