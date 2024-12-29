<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\setting_request;
use App\Models\setting;
use App\Trait\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class settingController extends Controller
{
    use ResizeImage;
    public function __construct(private string $view = "", private string $module = '', private string $module_title = '')
    {
        $this->view = "admin.module.setting.";
        $this->module = "setting";
        $this->module_title = __("modules.module_name.".$this->module);
    }
    public function setting(){
        return view("admin.module.setting.setting",[
            'module' => $this->module,
            'module_title' => $this->module_title
        ]);
    }

    public function store(setting_request $request){
        DB::beginTransaction();
        foreach ($request->all() as $key => $value) {
            if(is_object($value)){
                $value=$this->upload_file($this->module,$key);
            }
            setting::updateOrCreate(['key'=>$key,'lang'=>'1'],[
                'key'=>$key,
                'value'=>$value
            ]);
        }
        DB::commit();
        return back()->with('success', __('common.messages.success_edit',[
            'module' => $this->module_title
        ]));
    }
}
