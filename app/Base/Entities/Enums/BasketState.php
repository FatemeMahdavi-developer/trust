<?php

namespace App\Base\Entities\Enums;

enum BasketState: int
{
    case REGISTRATION = 1;
    case PREPARATION = 2;
    case CANCEL = 3;
}
