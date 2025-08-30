<?php

namespace App\Http\Controllers\site;

use App\Base\Entities\Enums\BoxState;
use App\Http\Controllers\Controller;
use App\Models\box;
use App\Models\LockerBank;

class select_box_controller extends Controller
{
    public function __invoke()
    {
        //todo: add state

        $boxes=box::where([
            'locker_bank_id'=>(int) request()->get('locker_bank_id'),
            'state'=>BoxState::EMPTY->value]
        )->get(['id','title']);

        return json_encode($boxes);
    }
}
