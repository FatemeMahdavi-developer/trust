<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\product_cat_request;
use App\Models\product_cat;
use App\Trait\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class product_cat_controller extends Controller
{
    use ResizeImage;

    public function __construct(private string $view='',private string $module ='',private string $module_title ='')
    {
        $this->module = "product_cat";
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
    $product_cats=product_cat::filter($request->all())->orderby('id','desc')->paginate(5)->withQueryString();
     $product_cats_search=product_cat::where('catid','0')->with('sub_cats')->get();
     return view($this->view.'list',[
        'product_cats'=>$product_cats,
        'product_cats_search'=>$product_cats_search,
        'module_title'=>$this->module_title
     ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_cats=product_cat::where('catid','0')->get();
        return view($this->view.'new',[
            'module'=>$this->module,
            'module_title'=>$this->module_title,
            'product_cats'=>$product_cats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(product_cat_request $request)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        $pic_banner=$this->upload_file($this->module,'pic_banner');
        $inputs=$request->validated();
        $inputs['pic']=$pic;
        $inputs['pic_banner']=$pic_banner;
        $inputs['admin_id']=auth()->user()->id;
        $inputs['seo_index_kind']=$request->seo_index_kind ?? '1';
        product_cat::create($inputs);
        DB::commit();
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product_cat $product_cat)
    {
        $product_cats=product_cat::where('catid','0')->get();
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'product_cats' => $product_cats,
            'product_cat' => $product_cat,
            'module'=>$this->module
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(product_cat_request $request, string $id)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        $pic_banner=$this->upload_file($this->module,'pic_banner');
        $inputs = $request->validated();
        $inputs['pic'] = $pic;
        $inputs['pic_banner'] = $pic_banner;
        product_cat::find($id)->update($inputs);
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
        product_cat::where('id',$id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' =>'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return (new admin_controller())->action($request,product_cat::class);
    }
    
}
