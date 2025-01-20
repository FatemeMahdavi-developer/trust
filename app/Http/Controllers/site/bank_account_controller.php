<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\account_number;
use Illuminate\Http\Request;

class bank_account_controller extends Controller
{
    public function __invoke()
    {
        $account_number=account_number::where('id',request()->get('account_number_id'))->first();
        return json_encode($account_number);
    }
}
