<?php

namespace App\Base\Entities\Enums;

enum PaymentPayWayEnum: string
{
    case DRAFT = 'draft';
    case ONLINE = 'online';
    case WALLET = 'wallet';
}
