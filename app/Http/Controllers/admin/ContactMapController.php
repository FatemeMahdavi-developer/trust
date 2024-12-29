<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\contactmap_request;
use App\Models\contactmap;
use Illuminate\Http\Request;

class ContactMapController extends Controller
{
    public function __construct(private string $view='',private string $module ='',private string $module_title ='')
    {
        $this->module = "contactmap";
        $this->view = "admin.module.".$this->module.".";
        $this->module_title = __("modules.module_name." . $this->module);

        foreach (trans("modules.crud_authorize") as $key => $value) {
            $authorize_name=sprintf("authorize:%s_%s",$key,$this->module);
            $this->middleware($authorize_name)->only($value);
        }
    }

    public function edit()
    {
        $contactmap = contactmap::find('1');
        return view($this->view . 'edit', [
            'contactmap' => $contactmap,
            'module_title' => $this->module_title,
            'module' => $this->module,
        ]);
    }

    public function update(contactmap_request $request){
        $inputs=$request->validated();
        $inputs['admin_id']=auth()->user()->id;
        contactmap::find('1')->update($inputs);
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }
}
