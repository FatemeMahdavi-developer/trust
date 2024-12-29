<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\manager_request;
use App\Models\admin;
use App\Models\province;
use App\Models\role;
use App\Trait\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class manager_controller extends Controller
{
    use ResizeImage;

    private string $view = "";
    private string $module = "";
    private string $module_title = "";

    public function __construct()
    {
        $this->view = "admin.module.manager.";
        $this->module = "manager";
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
        $roles=role::select('id','title')->get();
        $manager = admin::where('is_main', '0')->filter($request->all())->paginate(5)->withQueryString();
        return view($this->view . "list", [
            'manager' => $manager,
            'module_title' => $this->module_title,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces=province::select('id', 'name')->where('state', '1')->get();
        $roles=role::select('id','title')->get();
        return view($this->view . "new", [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'provinces' => $provinces,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(manager_request $request)
    {
        DB::beginTransaction();
        $pic = $this->upload_file($this->module, 'pic');
        admin::create([
            'fullname' => $request->fullname,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'admin_id' => auth()->user()->id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'province' => $request->province,
            'city' => $request->city,
            'role_id' => $request->role_id,
            'pic' => $pic,
        ]);
        DB::commit();
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(admin $manager)
    {
        $provinces = province::select('id', 'name')->where('state', '1')->get();
        $roles=role::select('id','title')->get();
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'provinces' => $provinces,
            'manager' => $manager,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(manager_request $request, admin $manager)
    {
        DB::beginTransaction();
        $pic = $this->upload_file($this->module, 'pic');
        $manager->update([
            'fullname' => $request->fullname,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'username' => $request->username,
            'province' => $request->province,
            'city' => $request->city,
            'role_id' => $request->role_id,
            'pic' => $pic,
        ]);
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
        admin::findOrFail($id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $action_type = $request->action_type;
        return json_encode($this->$action_type($request));
    }

    private function delete_all($request)
    {
        admin::whereIn('id', $request->item)->delete();
        return true;
    }
}
