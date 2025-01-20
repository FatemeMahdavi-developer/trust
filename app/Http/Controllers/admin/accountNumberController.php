<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\account_number_request;
use App\Models\account_number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class accountNumberController extends Controller
{
    public function __construct(private string $view = "", private string $module = '', private string $module_title = '')
    {
        $this->view = "admin.module.account_number.";
        $this->module = "account_number";
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
        $account_numbers = account_number::filter($request->all())->paginate(5);
        return view($this->view . 'list', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'account_numbers' => $account_numbers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view . 'new', [
            'module_title' => $this->module_title,
            'module' => $this->module
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(account_number_request $request)
    {
        $module = $this->module . "_type_" . $request->type;
        $inputs = $request->validated();
        $inputs['admin_id'] = auth()->user()->id;
        account_number::create($inputs);
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $account_number = account_number::find($id);
        return view($this->view . 'edit', [
            'account_number' => $account_number,
            'module_title' => $this->module_title,
            'module' => $this->module
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(account_number_request $request,string $id)
    {
        $inputs = $request->validated();
        account_number::find($id)->update($inputs);
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        account_number::where('id', $id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, account_number::class);
    }
}
