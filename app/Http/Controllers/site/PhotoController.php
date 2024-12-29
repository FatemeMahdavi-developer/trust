<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\gallery;
use App\Models\gallery_cat;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function __construct(private string $module='',private string $module_title='')
    {
        $this->module="photo";
        $this->module_title=trans("modules.module_name_site.".$this->module);
    }

    public function index(gallery_cat $photo_cat=null){
        $module_title=$this->module_title;
        $gallery=[];
        $breadcrumb=[];
        $gallery_cats=gallery_cat::where(['kind'=>'1','catid'=>'0','state'=>'1'])
            ->orderByRaw("`order` ASC, `id` DESC")
            ->get();
        if ($photo_cat instanceof gallery_cat) {

            $gallery_cats=gallery_cat::where(['kind'=>'1','catid'=>$photo_cat->id,'state'=>'1'])
                ->with('sub_cats_site')
                ->orderByRaw("`order` ASC, `id` DESC")
                ->get();

            $gallery=$photo_cat->gallery()->siteFilter()->get();

            $breadcrumb=$photo_cat->parents()->where('state','1');

            if (!$photo_cat->state){
                abort(404);
            }
        }
        return view('site.photo',compact('photo_cat','gallery','gallery_cats','breadcrumb','module_title'),
        );       
    }
}