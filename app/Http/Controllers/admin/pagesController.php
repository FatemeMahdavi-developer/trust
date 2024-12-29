<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\pageRequest;
use App\Http\Requests\admin\product_cat_request;
use App\Models\page;
use App\Trait\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class pagesController extends Controller
{
    use ResizeImage;
    private string $view = "";
    private string $module = "";
    private string $module_title = "";

    public function __construct()
    {
        $this->view = "admin.module.page.";
        $this->module = "page";
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
        $pages = page::filter($request->all())->paginate(4)->withQueryString();
        return view($this->view . "list", [
            'pages' => $pages,
            'module_title' => $this->module_title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view($this->view . 'new', [
            'module_title' => $this->module_title,
            'module' => $this->module
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(pageRequest $request)
    {
        DB::beginTransaction();
        $inputs=$request->all();
        $inputs["pic"]=$this->upload_file($this->module,'pic');
        page::create($inputs);
        DB::commit();
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page=page::find($id);
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'page' => $page,
            'module'=>$this->module
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(pageRequest $request, string $id)
    {
        DB::beginTransaction();
        $inputs=$request->all();
        $inputs["pic"]=$this->upload_file($this->module,'pic');
        $pages=page::find($id);
        $pages->update($inputs);
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
        page::where('id',$id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' =>'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request,page::class);
    }
}
