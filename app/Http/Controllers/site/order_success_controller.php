<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class order_success_controller extends Controller
{
    public function __construct(public string $module='',public string $module_title='',public string $module_pic=''){
        $this->module='order';
        $this->module_title=app("setting")[$this->module."_title"] ?? __("modules.module_name_site.".$this->module);
        $this->module_pic=app("setting")[$this->module."_pic"] ?? '';
    }


    public function order_success()
    {
            return view('site.order_success',[
                'module_title'=>$this->module_title,
                'module_pic'=>$this->module_pic,
            ]);
    }
}
