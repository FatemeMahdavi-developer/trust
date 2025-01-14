<?php

namespace App\base\Entities\Enums;

enum BoxState: int
{
    case EMPTY = 1;
    case FILL = 2;
    case RESERVED = 3;
}

