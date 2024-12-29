<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\ContacRequest;
use App\Models\contactmap;
use App\Models\message;
use App\Models\message_cat;

class ContactController extends Controller
{
    public function __construct(public string $module='',public string $module_title='',public string $module_pic=''){
        $this->module='contact';
        $this->module_title=app("setting")[$this->module."_title"] ?? __("modules.module_name_site.".$this->module);
        $this->module_pic=app("setting")[$this->module."_pic"] ?? '';
    }
    public function contact()
    {
        $contactmap= contactmap::find('1')->get(['lgmap','qgmap','zgmap','cgmap'])->Toarray();

        $contact_unit=message_cat::where("state",'1')->get(['id','title']);

        $message_cats = message_cat::where('catid','0')->get();
        return view('site.contact',[
            'lgmap'=>$contactmap[0]['lgmap'],
            'qgmap'=>$contactmap[0]['qgmap'],
            'zgmap'=>$contactmap[0]['zgmap'],
            'cgmap'=>$contactmap[0]['cgmap'],
            'module_title'=>$this->module_title,
            'module_pic'=>$this->module_pic,
            'contact_unit'=>$contact_unit,
            'tell'=>app("setting")["tell_".$this->module] ?? '',
            'email'=>app("setting")["email_".$this->module] ?? '',
            'address'=>app("setting")["address_".$this->module] ?? '',
            'message_cats'=>$message_cats,
        ]);
    }

    public function store(ContacRequest $request){
        $inputs=$request->validated();
        $inputs["ip_address"]=$request->ip();
        message::create($inputs);
        return back()->with('success',__('common.contact_success'));
    }
}
