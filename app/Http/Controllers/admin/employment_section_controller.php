<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\employment_section_request;
use App\Models\employment_section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class employment_section_controller extends Controller
{
    public function __construct(private string $view = "",private string $module = "",private string $module_title = "")
    {
        $this->module = "employment_section";
        $this->view = "admin.module.".$this->module;
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
        $employment_section=employment_section::filter($request->all())->orderby('id','desc')->paginate(5)->withQueryString();
        return view($this->view . '.list',[
            'module_title' => $this->module_title,
            'module' => $this->module,
            'employment_section'=>$employment_section
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view . '.new', [
            'module_title' => $this->module_title,
            'module' => $this->module
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(employment_section_request $request)
    {
        $inputs=$request->validated();
        $inputs['admin_id']=auth()->user()->id;
        employment_section::create($inputs);
        return back()->with('success',__('common.messages.success',[ 
            'module' => $this->module_title
        ]));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employment_section=employment_section::find($id);
        return view($this->view.'.edit',[
            'module_title' => $this->module_title,
            'module' => $this->module,
            'employment_section'=>$employment_section
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(employment_section_request $request, string $id)
    {
        $inputs=$request->validated();
        employment_section::find($id)->update($inputs);
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        employment_section::find($id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request,employment_section::class);
    }

}
