<?php

namespace App\Http\Controllers\admin;

use App\base\class\admin_controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\news_request;
use App\Models\news;
use App\Models\news_cat;
use App\Trait\convert_date_to_timestamp;
use App\Trait\ResizeImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;

class news_controller extends Controller
{

    use ResizeImage, convert_date_to_timestamp;

    private string $view = "";
    private string $module = "";
    private string $module_title = "";

    public function __construct()
    {
        $this->view = "admin.module.news.";
        $this->module = "news";
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
        $news = news::with('news_cat')->filter($request->all())->paginate(4);
        $news_cats_search = news_cat::with(['sub_cats'])->where('catid', '0')->get();
        return view($this->view . "list", [
            'module_title' => $this->module_title,
            'news_cats_search' => $news_cats_search,
            'news' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news_cats = news_cat::where('catid', '0')->with('sub_cats')->get();
        return view($this->view . "new", [
            'module_title' => $this->module_title,
            'news_cats' => $news_cats,
            'module' => $this->module,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(news_request $request)
    {
        DB::beginTransaction();

        $pic=$this->upload_file($this->module,'pic');
        $pic_banner = $this->upload_file($this->module,'pic_banner');
        $validity_date = Carbon::now()->format("Y/m/d");
        if (!empty($request->validity_date[0])) {
            $validity_date = $this->convert_date_to_timestamp($request->validity_date);
        }
        news::create([
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
            'validity_date' => $validity_date,
            'catid' => $request->catid,
            'pic' => $pic,
            'alt_pic' => $request->alt_pic,
            'pic_banner' => $pic_banner,
            'alt_pic_banner' => $request->alt_pic_banner,
            'note' => $request->note,
            'note_more' => $request->note_more,
        ]);
        DB::commit();
        return back()->with('success', __('common.messages.success', [
            'module' => $this->module_title
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(news $news)
    {
        $news_cats = news_cat::where('catid', '0')->with('sub_cats')->get();

        return view($this->view . "edit", [
            'module_title' => $this->module_title,
            'news_cats' => $news_cats,
            'news' => $news,
            'module' => $this->module,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(news_request $request, news $news)
    {
        DB::beginTransaction();
        $pic=$this->upload_file($this->module,'pic');
        $pic_banner = $this->upload_file($this->module,'pic_banner');
        $validity_date = Carbon::now()->format("Y/m/d");
        if (!empty($request->validity_date[0])) {
            $validity_date = $this->convert_date_to_timestamp($request->validity_date);
        }
        $news->update([
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
            'validity_date' => $validity_date,
            'catid' => $request->catid,
            'pic' => $pic,
            'alt_pic' => $request->alt_pic,
            'pic_banner' => $pic_banner,
            'alt_pic_banner' => $request->alt_pic_banner,
            'note' => $request->note,
            'note_more' => $request->note_more,
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
        news::where('id', $id)->where('admin_id', '1')->delete();
        return true;
    }

    public function action_all(Request $request)
    {
        $filed_validation = ['item' => 'required'];
        $validator = Validator::make($request->all(), $filed_validation);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        return (new admin_controller())->action($request, news::class);
    }
}
