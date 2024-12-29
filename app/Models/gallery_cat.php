<?php

namespace App\Models;

use App\Trait\Breadcrumb;
use App\Trait\date_convert;
use App\Trait\seo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class gallery_cat extends Model
{
    use HasFactory,SoftDeletes,date_convert,seo,Breadcrumb;

    protected $appends=['url','alt_image','alt_banner_image','kind_title'];

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
        'admin_id',
        'kind',
        'title',
        'catid',
        'pic',
        'alt_pic',
        'pic_banner',
        'alt_pic_banner',
        'order',
        'state',
        'state_main',
    ];

    public function getAltImageAttribute()
    {
        return !empty($this->alt_pic) ? $this->alt_pic : $this->title;
    }


    public function getAltImageBannerAttribute()
    {
        return !empty($this->alt_pic_banner) ? $this->alt_pic_banner : $this->title;
    }

    public function getKindTitleAttribute()
    {
        return trans('common.multimedia.'.$this->kind);
    }
    
    public function getUrlAttribute(){
        if($this->kind=='1'){
            return route('photo.index_cat',['photo_cat'=>$this->seo_url]);
        }elseif($this->kind=='2'){
            return route('video.index_cat',['video_cat'=>$this->seo_url]);
        };
    }
    public function scopeFilter(Builder $builder,$params){
        if(!empty($params['catid'])){
            $builder->where("catid",$params['catid']);
        }else{
            $builder->where('catid','0');
        }
        if(!empty($params['title'])){
            $builder->where("title",'like','%'.$params["title"].'%');
        }
    }
    public function sub_cats(){
        return $this->hasMany(gallery_cat::class,'catid')->select('id','title','catid','seo_url','kind');
    }

    public function sub_cats_site(){
        return $this->hasMany(gallery_cat::class,'catid')->select('id','title','catid','seo_url','kind')->where('state','1');
    }

    public function gallery(){
        return $this->hasMany(gallery::class,'catid');
    }

    public function getSubcatIds($categoryId,$children = [])
    {
        $children[] = $categoryId;
        // دریافت زیرشاخه‌های این دسته‌بندی
        $parentCategories = gallery_cat::where('catid', $categoryId)->where('state','1')
            ->latest()
            ->select('id')
            ->get();
        foreach ($parentCategories as $category) {
            // بررسی اینکه آیا این دسته‌بندی قبلاً پردازش شده است یا خیر
            if (!in_array($category->id, $children)) {
                $children =$this->getSubcatIds($category->id,$children);
            }
        }
        // Arr::flatten => تبدیل آرایه چند بعدی به آرایه تک بعدی
        return Arr::flatten($children);
    }

    public function getgalleryBySubCat()
    {
        $subcategoryIds = $this->getSubcatIds($this->id);
        $galleries=gallery::whereIn('catid', $subcategoryIds)->where('state','1')->get();
        return $galleries;
    }

    public function scopeSiteFilter(Builder $builder)
    {
        $builder->where('state','1')->where('catid','0')->orderByRaw("`order` ASC,`id` DESC")->select(['id','seo_url','kind','title','catid','pic','alt_pic']);
        if (!empty(request()->has('kind'))) {
            $builder->where('kind',request()->get('kind'));
        }
        return $builder;
    }

}
