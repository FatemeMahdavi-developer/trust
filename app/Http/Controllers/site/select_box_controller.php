<?php

namespace App\Http\Controllers\site;

use App\Base\Entities\Enums\BoxState;
use App\Http\Controllers\Controller;
use App\Models\box;

class select_box_controller extends Controller
{
    public function __invoke()
    {
        $box=box::where('size_id',request()->get('size_id'))->where('state',BoxState::EMPTY->value)->get(["id","title"]);
        return json_encode($box);
    }
}
