<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Base\Entities\Enums\BoxState;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\box_request;
use App\Models\box;
use App\Models\size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\admin\enumAsOptions;

class boxController extends Controller
{
    public function __construct(private string $view = "", private string $module = '', private string $module_title = '')
    {
        $this->view = "admin.module.box.";
        $this->module = "box";
        $this->module_title = __("modules.module_name." . $this->module);

        foreach (trans("modules.crud_authorize") as $key => $value) {
            $authorize_name=sprintf("authorize:%s_%s",$key,$this->module);
            $this->middleware($authorize_name)->only($value);
        }
    }


    public function index(Request $request)
    {
        $box = box::filter($request->all())->orderBy('id','DESC')->paginate(5);
        $sizes = size::all();
        $state=collect(enumAsOptions(BoxState::cases(),app(box::class)->enumsLang()))->pluck('label','value');
        return view($this->view . 'list', [
            'module_title' => $this->module_title,
            'module' => $this->module,
            'box' => $box,
            'state' => $state,
            'sizes' => $sizes,
        ]);
    }

    public function create()
    {
        $sizes = size::all();
        $state=collect(enumAsOptions(BoxState::cases(),app(box::class)->enumsLang()))->pluck('label','value');
        return view($this->view . "new", [
            'module_title' => $this->module_title,
            'sizes' => $sizes,
            'state' => $state,
            'module' => $this->module,
        ]);
    }

    public function store(box_request $request)
    {
        $inputs = $request->validated();
    
        $inputs['admin_id'] = auth()->user()->id;
        box::create($inputs);
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }


    public function edit(string $id)
    {
        $box = box::find($id);
        $state=collect(enumAsOptions(BoxState::cases(),app(box::class)->enumsLang()))->pluck('label','value');
        $sizes = size::all();
        return view($this->view . 'edit', [
            'box' => $box,
            'module_title' => $this->module_title,
            'sizes' => $sizes,
            'state' => $state,
            'module' => $this->module,
        ]);
    }

    public function update(box_request $request,string $id)
    {
        $inputs = $request->validated();
        box::find($id)->update($inputs);
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    public function destroy(string $id)
    {
        box::where('id', $id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, box::class);
    }

}
