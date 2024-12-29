<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\news_cat_request;
use App\Models\news_cat;
use App\Trait\ResizeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class news_cat_controller extends Controller
{
    use ResizeImage;

    private string $view = "";
    private string $module = "";
    private string $module_title = "";

    public function __construct()
    {
        $this->view = "admin.module.news_cat.";
        $this->module = "news_cat";
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
        $news_cats = news_cat::filter($request->all())->with(['sub_cats','news'])->orderBy('id','desc')->paginate(5)->withQueryString();
        $news_cats_search = news_cat::where("catid", "0")->with("sub_cats")->get();
        return view($this->view . "list", [
            'news_cats' => $news_cats,
            'news_cats_search' => $news_cats_search,
            'module_title' => $this->module_title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news_cats = news_cat::where('catid', '0')->get();
        return view($this->view . "new", [
            'module_title' => $this->module_title,
            'news_cats' => $news_cats,
            'module'=>$this->module
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(news_cat_request $request)
    {
        DB::beginTransaction();
        $pic_banner=$this->upload_file($this->module,'pic_banner');
        news_cat::create([
            'seo_title' => $request->seo_title,
            'seo_url' => $request->seo_url,
            'seo_h1' => $request->seo_h1,
            'seo_canonical' => $request->seo_canonical,
            'seo_redirect' => $request->seo_redirect,
            'seo_redirect_kind' => $request->seo_redirect_kind,
            'seo_index_kind' => $request->seo_index_kind ?? '1',
            'seo_keyword' => $request->seo_keyword,
            'seo_description' => $request->seo_description,
            'title' => $request->title,
            'catid' => $request->catid,
            'pic_banner' => $pic_banner,
            'alt_pic' => $request->alt_pic,
        ]);
        DB::commit();
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(news_cat $news_cat)
    {
        $news_cats = news_cat::where('catid', '0')->get();

        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'news_cat' => $news_cat,
            'news_cats' => $news_cats,
            'module'=>$this->module

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(news_cat_request $request, news_cat $news_cat)
    {
        DB::beginTransaction();
        $pic_banner=$this->upload_file($this->module,'pic_banner');
        $news_cat->update([
            'seo_title' => $request->seo_title,
            'seo_url' => $request->seo_url,
            'seo_h1' => $request->seo_h1,
            'seo_canonical' => $request->seo_canonical,
            'seo_redirect' => $request->seo_redirect,
            'seo_redirect_kind' => $request->seo_redirect_kind,
            'seo_index_kind' => $request->seo_index_kind ?? '1',
            'seo_keyword' => $request->seo_keyword,
            'seo_description' => $request->seo_description,
            'title' => $request->title,
            'catid' => $request->catid,
            'pic_banner' => $pic_banner,
            'alt_pic' => $request->alt_pic,
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
        news_cat::where('id', $id)->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return (new admin_controller())->action($request, news_cat::class);
    }


}
