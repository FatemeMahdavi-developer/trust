<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\province;
use Illuminate\Http\Request;

class province_city_controller extends Controller
{
    public function __invoke()
    {
        $province=province::findOrFail(request()->get('province_id'));
        return json_encode($province->cities);
    }
}
