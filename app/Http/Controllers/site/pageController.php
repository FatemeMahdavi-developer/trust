<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\page;
use Illuminate\Http\Request;

class pageController extends Controller
{
    public function page(string $page){
        $page=page::where('seo_url',$page)->firstOrFail();
        $contents=self::content($page);
        return view("site.page_info",compact('page','contents'));
    }

    public function content($page){
        $contents=[];
        $content_types=trans("common.content.page");
        $content=collect($page->content()->orderBy('order','desc')->get());
        foreach ($content_types as $key => $value) {
            $contents[$key]=$content->where('state','1')->where('kind',$key);
        }
        return $contents;
    }
}
