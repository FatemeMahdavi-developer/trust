<?php

namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;
use App\Models\LockerBank;

class select_size_controller extends Controller
{
    public function __invoke()
    {
        //todo: add state
        $lockerBanks= LockerBank::where('branch_id',(int)request()->get('branch_id'))->get(['id','size']);

        return json_encode($lockerBanks);
    }
}
