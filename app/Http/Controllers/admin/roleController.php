<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\role_request;
use App\Models\permissions;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\base\class\admin_controller;
use Illuminate\Support\Facades\Gate;

class roleController extends Controller
{

    public function __construct(private string $view = "", private string $module = '', private string $module_title = '')
    {
        $this->view = "admin.module.role.";
        $this->module = "role";
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
        // Gate::allows("group_access","read-news_cat");
        $roles=role::filter($request->all())->paginate(7);
        return view($this->view . 'list', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules_permission=[];
        $permissions=permissions::get();
        foreach (trans('modules.module_name') as $key => $module) {
            $modules_permission[$module]=$permissions->where("module",$key)->pluck("id","title_fa")->toArray();
        }
        return view($this->view . 'create', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'modules_permission' => $modules_permission,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(role_request $request)
    {
        DB::beginTransaction();
        try{
            $role=role::create([
                "title"=>$request->title,
                "admin_id"=>auth()->user()->id
            ]);
            $role->permission()->sync($request->permissions);
        }catch(\Exception $e){
            DB::rollback();
        }
        DB::commit();
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(role $role)
    {
        $modules_permission=[];
        $permissions=permissions::get();
        foreach (trans('modules.module_name') as $key => $module) {
            $modules_permission[$module]=$permissions->where("module",$key)->pluck("id","title_fa")->toArray();
        }
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'role' => $role,
            'module'=>$this->module,
            'modules_permission'=>$modules_permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(role_request $request, role $role)
    {
        DB::beginTransaction();
        try{
            $role->update([
                "title"=>$request->title
            ]);
            $role->permission()->sync($request->permissions);
        }catch(\Exception $e){
            DB::rollback();
        }
        DB::commit();
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        role::where('id', $id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, role::class);

    }
}
