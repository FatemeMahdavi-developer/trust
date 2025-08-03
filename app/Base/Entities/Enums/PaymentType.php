<?php

namespace App\Base\Entities\Enums;

enum PaymentType: int
{
    case PENDING = 1;
    case SUCCESS = 2;
    case FAILED = 3;
    case REVERSE = 4;
}

