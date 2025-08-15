<?php

namespace App\Base\Entities\Enums;


enum TransactionStatusEnum: string
{
    case NONE = 'none';

    case SUCCESS = 'success';

    case FAILED = 'failed';
}
