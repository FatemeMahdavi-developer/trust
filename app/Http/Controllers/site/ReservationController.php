<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\ContacRequest;
use App\Models\contactmap;
use App\Models\message;
use App\Models\message_cat;
use App\Models\size;

class ReservationController extends Controller
{
    public function __construct(public string $module='',public string $module_title='',public string $module_pic=''){
        $this->module='reservation';
        $this->module_title=app("setting")[$this->module."_title"] ?? __("modules.module_name_site.".$this->module);
        $this->module_pic=app("setting")[$this->module."_pic"] ?? '';
    }
    public function reservation()
    {
        $sizes = size::where('state','1')->get(['id','title']);
        return view('site.reservation',[
            'module_title'=>$this->module_title,
            'module_pic'=>$this->module_pic,
            'sizes'=>$sizes,
        ]);
    }

    public function store(ContacRequest $request){
        $inputs=$request->validated();
        $inputs["ip_address"]=$request->ip();
        message::create($inputs);
        return back()->with('success',__('common.contact_success'));
    }
}
