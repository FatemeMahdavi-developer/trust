<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Models\province;
use App\Models\User;
use App\Trait\convert_date_to_timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use convert_date_to_timestamp;
    public function __construct(private string $view = '', private string $module = '', private string $module_title = '')
    {
        $this->module = "user";
        $this->view = "admin.module." . $this->module . ".";
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
        $users = User::filter($request->all())->paginate(5)->withQueryString();
        return view("admin.module.user.list", [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);
        $provinces = province::select('id', 'name')->where('state', '1')->get();
        return view("admin.module.user.edit", [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'user' => $user,
            'provinces' => $provinces,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user=User::find($id);
        $input=$request->validated();
        $input["password"]=$user["password"];
        if(!empty($input["password"])){
            $input["password"]=Hash::make($request->get("password"));
        }
        $input['date_birth'] = convert_to_timestamp($request->date_birth,"/");
        $user->update($input);
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        if ($request->action_type == "delete_all") {
            User::whereIn('id', $request->item)->delete();
            return true;
        }
        else {
            return (new admin_controller())->action($request, User::class);

        }
    }
}
