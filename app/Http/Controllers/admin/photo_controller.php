<?php
namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\gallery_request;
use App\Models\gallery;
use App\Models\gallery_cat;
use App\Trait\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class photo_controller extends Controller
{
    use ResizeImage;
    public function __construct(private string $view='',private string $module ='',private string $module_title ='')
    {
        $this->module = "photo";
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
        $photo=gallery::where('kind','1')->with('gallery_cat')->filter($request->all())->orderBy('id','DESC')->paginate(4);
        $photo_cats_search = gallery_cat::where('kind','1')->with(['sub_cats'])->where('catid', '0')->get();
        return view($this->view . "list", [
            'module_title' => $this->module_title,
            'photo_cats_search' => $photo_cats_search,
            'photo' => $photo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $photo_cats = gallery_cat::where('kind','1')->where('catid','0')->with('sub_cats')->get();
        return view($this->view."new", [
            'module_title' => $this->module_title,
            'photo_cats' => $photo_cats,
            'module' => $this->module,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(gallery_request $request)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        $inputs=$request->validated();
        $inputs['seo_title']='';
        $inputs['seo_url']='';
        $inputs['kind']=1;
        $inputs['pic']=$pic;
        $inputs['admin_id']=auth()->user()->id;
        gallery::create($inputs);
        DB::commit();
        return back()->with('success', __('common.messages.success',[
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(gallery $photo)
    {
        $photo_cats = gallery_cat::where('kind','1')->where('catid','0')->with('sub_cats')->get();
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'photo_cats' => $photo_cats,
            'photo' => $photo,
            'module' => $this->module,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(gallery_request $request,gallery $photo)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        $inputs=$request->validated();
        $inputs['seo_title']='';
        $inputs['seo_url']='';
        $inputs['kind']=1;
        $inputs['pic']=$pic;
        $photo->update($inputs);
        DB::commit();
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    public function destroy(string $id)
    {
        gallery::where('kind','1')->where('id',$id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request,gallery::class);
    }
}
