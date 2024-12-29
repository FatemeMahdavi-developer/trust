<?php
namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\message_cat_request;
use App\Models\message_cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class message_cat_controller extends Controller
{
    public function __construct(private string $view='',private string $module ='',private string $module_title ='')
    {
        $this->module = "message_cat";
        $this->view = "admin.module.".$this->module.".";
        $this->module_title = __("modules.module_name." . $this->module);

        foreach (trans("modules.crud_authorize") as $key => $value) {
            $authorize_name=sprintf("authorize:%s_%s",$key,$this->module);
            $this->middleware($authorize_name)->only($value);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $message_cats=message_cat::filter($request->all())->orderby('id','desc')->paginate(5)->withQueryString();
     $message_cats_search=message_cat::where('catid','0')->with('sub_cats')->get();
     return view($this->view.'list',[
        'message_cats'=>$message_cats,
        'message_cats_search'=>$message_cats_search,
        'module_title'=>$this->module_title
     ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $message_cats=message_cat::where('catid','0')->get();
        return view($this->view.'new',[
            'module'=>$this->module,
            'module_title'=>$this->module_title,
            'message_cats'=>$message_cats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(message_cat_request $request)
    {
        $inputs=$request->validated();
        $inputs['admin_id']=auth()->user()->id;
        message_cat::create($inputs);
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(message_cat $message_cat)
    {
        $message_cats=message_cat::where('catid','0')->get();
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'message_cats' => $message_cats,
            'message_cat' => $message_cat,
            'module'=>$this->module
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(message_cat_request $request, string $id)
    {
        $inputs = $request->validated();
        message_cat::find($id)->update($inputs);
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        message_cat::where('id',$id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' =>'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request,message_cat::class);
    }
    
}
