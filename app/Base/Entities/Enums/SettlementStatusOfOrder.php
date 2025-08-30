<?php

namespace App\Base\Entities\Enums;

enum SettlementStatusOfOrder: string
{
    case PENDING = 'pending';
    case SETTLED = 'settled';
}

