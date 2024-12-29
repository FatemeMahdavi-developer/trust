<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\province;
use Illuminate\Http\Request;

class province_city_controller extends Controller
{
    public function __invoke()
    {
        $province=province::findOrFail(request()->province_id);
        return json_encode($province->cities);
    }
}
