<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\gallery;
use App\Models\gallery_cat;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function __construct(private string $module='',private string $module_title='')
    {
        $this->module="video";
        $this->module_title=trans("modules.module_name_site.".$this->module);
    }

    public function index(gallery_cat $video_cat=null){
        $module_title=$this->module_title;
        $gallery=[];
        $breadcrumb=[];
        $gallery_cats=gallery_cat::where(['kind'=>'2','catid'=>'0','state'=>'1'])
            ->orderByRaw("`order` ASC, `id` DESC")
            ->get();
        if ($video_cat != null) {
            $gallery_cats=gallery_cat::where(['kind'=>'2','catid'=>$video_cat->id,'state'=>'1'])
                ->with('sub_cats_site')
                ->orderByRaw("`order` ASC, `id` DESC")->get();
            $gallery=$video_cat->gallery()->siteFilter()->get();
            $breadcrumb=$video_cat->parents()->where('state','1');
            if (!$video_cat->state){
                abort(404);
            }
        }
        return view('site.video', compact('video_cat','gallery','gallery_cats','breadcrumb','module_title'));       
    }

    public function show(Request $request,gallery $video)
    {
        $module_title=$this->module_title;
        if (!$video->state)
            abort(404);
        $breadcrumb=$video->gallery_cat->parents()->where('state','1');
        return view('site.video_info',compact('video','breadcrumb','module_title'));
    }
}
