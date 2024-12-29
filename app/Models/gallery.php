<?php

namespace App\Models;

use App\Trait\date_convert;
use App\Trait\seo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gallery extends Model
{
    use HasFactory,SoftDeletes,date_convert,seo;

    protected $appends=['alt_image','url'];

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
        'video',
        'is_aparat',
        'aparat_video',
        'pic',
        'alt_pic',
        'pic_banner',
        'alt_pic_banner',
        'note',
        'order',
        'state',
        'state_main',
    ];

    public function getAltImageAttribute()
    {
        return !empty($this->alt_pic) ? $this->alt_pic : $this->title;
    }

    public function gallery_cat(){
        return $this->belongsTo(gallery_cat::class,'catid')->select('id','title','catid','kind','seo_url');
    }

    public function admin(){
        return $this->belongsTo(admin::class,'admin_id')->select('id','fullname');
    }

    public function scopeFilter(Builder $builder,$params){
        if(!empty($params['catid'])){
            $builder->where('catid',$params['catid']);
        }
        if(!empty($params['title'])){
            $builder->where('title','like','%' .$params['title']. '%');
        }
        return $builder;
    }

    public function scopeSiteFilter(Builder $builder)
    {
        $builder->where('state','1')->with(['gallery_cat'])->orderByRaw("`order` ASC,`id` DESC")->select(['id','kind','title','pic','catid','alt_pic','seo_url']);
        if (!empty(request()->has('kind'))) {
            $builder->where('kind',request()->get('kind'));
        }
        return $builder;
    }

    public function getUrlAttribute(){
        if($this->kind=='2'){
            return route('video.index_cat',['video_cat'=>$this->seo_url]);
        };
    }
}
