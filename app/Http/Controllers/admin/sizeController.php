<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\size_request;
use App\Models\size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class sizeController extends Controller
{
    public function __construct(private string $view = "", private string $module = '', private string $module_title = '')
    {
        $this->view = "admin.module.size.";
        $this->module = "size";
        $this->module_title = __("modules.module_name." . $this->module);

        foreach (trans("modules.crud_authorize") as $key => $value) {
            $authorize_name=sprintf("authorize:%s_%s",$key,$this->module);
            $this->middleware($authorize_name)->only($value);
        }
    }

    public function index(Request $request)
    {
        $sizes = size::filter($request->all())->orderBy('id','DESC')->paginate(5);
        return view($this->view . 'list', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'sizes' => $sizes,
        ]);
    }

    public function create()
    {
        return view($this->view . 'new', [
            'module_title' => $this->module_title,
            'module' => $this->module
        ]);
    }

    public function store(size_request $request)
    {
        $inputs = $request->validated();
        $inputs['admin_id'] = auth()->user()->id;
        size::create($inputs);
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }

    public function edit(string $id)
    {
        $size = size::find($id);
        return view($this->view . 'edit', [
            'size' => $size,
            'module_title' => $this->module_title,
            'module' => $this->module
        ]);
    }

    public function update(size_request $request, string $id)
    {
        $inputs = $request->validated();
        size::find($id)->update($inputs);
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    public function destroy(string $id)
    {
        size::where('id', $id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, size::class);
    }

}
