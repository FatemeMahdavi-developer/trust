<?php

namespace App\Models;

use App\Trait\Breadcrumb;
use App\Trait\date_convert;
use App\Trait\seo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


class news_cat extends Model
{
    use HasFactory,SoftDeletes,date_convert,seo,Breadcrumb;
    protected $appends=['url'];
    protected $fillable=[
        'seo_title',
        'seo_url',
        'seo_h1',
        'seo_canonical',
        'seo_redirect',
        'seo_redirect_kind',
        'seo_index_kind',
        'seo_keyword',
        'seo_description',
        'title',
        'catid',
        'pic_banner',
        'alt_pic',
        'order',
        'state',
    ];

    public function sub_cats(){
        return $this->hasMany(news_cat::class,'catid')->with('sub_cats')->select("id","title","catid");
    }

    public function __parent(){
        return $this->belongsTo(news_cat::class,'catid')->where('state','1');
    }
    public function scopeFilter(Builder $builder , $params){
        if(!empty($params['catid'])){
            $builder->where("catid",$params["catid"]);
        }else{
            $builder->where("catid",'0');
        }
        if(!empty($params['title'])){
            $builder->where('title', 'like', '%' . $params["title"] . '%');
        }
        return $builder;
    }


    public function news(){
        return $this->hasMany(news::class,'catid');
    }


    public function getUrlAttribute(){
        return route('news.index_cat',['news_cat'=>$this->seo_url]);
    }



}
