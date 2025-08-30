<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\news;
use Carbon\Carbon;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function __invoke(Request $request){


        $news=news::where('state','1')
        ->where('validity_date','<=',Carbon::now())
        ->where('title','like','%'.$request->keyword.'%')
        ->orWhere('seo_keyword','like','%'.$request->keyword.'%')
        ->orWhere('seo_description','like','%'.$request->keyword.'%')->get();

        return view('site.search',['news'=>$news]);
    }
}
