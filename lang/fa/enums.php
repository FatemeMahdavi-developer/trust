<?php

use App\base\Entities\Enums\BoxState;

return [
    BoxState::class => [
        BoxState::EMPTY->name => 'خالی',
        BoxState::FILL->name => 'پر',
        BoxState::RESERVED->name => 'رزرو شده',
    ]
];
