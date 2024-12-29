<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\news;
use App\Models\product;
use App\Models\product_cat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function __invoke(Request $request){
        $product=product::where('state','1')
        ->where('title','like','%'.$request->keyword.'%')
        ->orWhere('seo_keyword','like','%'.$request->keyword.'%')
        ->orWhere('seo_description','like','%'.$request->keyword.'%')->get();

        $product_cat=product_cat::where('state','1')
        ->where('title','like','%'.$request->keyword.'%')
        ->orWhere('seo_keyword','like','%'.$request->keyword.'%')
        ->orWhere('seo_description','like','%'.$request->keyword.'%')->get();

        $news=news::where('state','1')
        ->where('validity_date','<=',Carbon::now())
        ->where('title','like','%'.$request->keyword.'%')
        ->orWhere('seo_keyword','like','%'.$request->keyword.'%')
        ->orWhere('seo_description','like','%'.$request->keyword.'%')->get();
      
        return view('site.search',['product_cat'=>$product_cat,'product'=>$product,'news'=>$news]);
    }
}