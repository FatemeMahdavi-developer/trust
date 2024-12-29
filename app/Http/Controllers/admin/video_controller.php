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

class video_controller extends Controller
{
    use ResizeImage;
    public function __construct(private string $view='',private string $module ='',private string $module_title ='')
    {
        $this->module = "video";
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
        $video=gallery::where('kind',2)->with('gallery_cat')->filter($request->all())->orderBy('id','DESC')->paginate(4);
        $video_cats_search = gallery_cat::where('kind',2)->with(['sub_cats'])->where('catid', '0')->get();
        return view($this->view . "list", [
            'module_title' => $this->module_title,
            'video_cats_search' => $video_cats_search,
            'video' => $video
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $video_cats = gallery_cat::where('kind','2')->where('catid','0')->with('sub_cats')->get();
        return view($this->view."new", [
            'module_title' => $this->module_title,
            'video_cats' => $video_cats,
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
        $pic_banner=$this->upload_file($this->module,'pic_banner');
        $inputs=$request->validated();
        $inputs['kind']=2;
        $inputs['pic']=$pic;
        $inputs['pic_banner']=$pic_banner;
        $inputs['admin_id']=auth()->user()->id;
        $inputs['seo_index_kind']=$request->seo_index_kind ?? '1';
        gallery::create($inputs);
        DB::commit();
        return back()->with('success', __('common.messages.success',[
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(gallery $video)
    {
        $video_cats = gallery_cat::where('kind','2')->where('catid','0')->with('sub_cats')->get();
        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'video_cats' => $video_cats,
            'video' => $video,
            'module' => $this->module,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(gallery_request $request,gallery $video)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        $pic_banner=$this->upload_file($this->module,'pic_banner');
        $film=$this->upload_file($this->module,'video');
        $inputs=$request->validated();
        $inputs['kind']=2;
        $inputs['pic']=$pic;
        $inputs['pic_banner']=$pic_banner;
        $inputs['video']=$film;

        if(@$inputs['is_aparat']==1){
            $inputs['video']=null;
        }elseif(!empty($inputs['video'])){
            $inputs['is_aparat']='0';
            $inputs['aparat_video']=null;
        }
        $inputs['seo_index_kind']=$request->seo_index_kind ?? '1';
        $video->update($inputs);
        DB::commit();
        return back()->with('success', __('common.messages.success_edit', [
            'module' => $this->module_title
        ]));
    }

    public function destroy(string $id)
    {
        gallery::where('kind',2)->where('id',$id)->delete();
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
