<?php

namespace App\Base\Entities\Enums;

enum PricingType: string
{
    case HOURLY = 'hourly';
    case DAILY = 'daily';
    case MONTHLY = 'monthly';
}

