<?php

namespace App\Models;
use App\Trait\Comment;
use App\Trait\date_convert;
use App\Trait\Like;
use App\Trait\morph_content;
use App\Trait\Rate;
use App\Trait\seo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory,SoftDeletes,date_convert,morph_content,seo,Comment,Like,Rate;

    protected $appends=['alt_image','alt_image_banner','url'];

    protected $fillable = [
        'admin_id',
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
        'price',
        'code',
        'status',
        'pic',
        'alt_pic',
        'pic_banner',
        'alt_pic_banner',
        'order',
        'state',
        'note',
        'note_more',
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
    
    public function getUrlAttribute(){
        return route('product.show',['product'=>$this->seo_url]);
    }

    public function product_cat(){
        return $this->belongsTo(product_cat::class,'catid')->select('id','title','catid','seo_url');
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

    public function scopeSiteFilter(Builder $builder,$params)
    {
        $builder->where('state', '1')->orderByRaw("`order` ASC, `id` DESC")->with(['product_cat'])->select(['title','note','pic','price','catid','alt_pic','seo_url']);
        if (!empty(request()->has('keyword'))) {
            $builder->where('title', 'like', '%' . $params['keyword'] . '%')
                ->orWhere('seo_keyword', 'LIKE', '%'.$params['keyword'] .'%')
                ->orWhere('seo_description', 'LIKE', '%'.$params['keyword'].'%')
                ->orWhere('note', 'LIKE', '%'.$params['keyword'].'%')
                ->orWhere('note_more', 'LIKE', '%'.$params['keyword'].'%');
        }
        if(isset($params['catid'])){
            
            $builder->whereIn('catid',$params['catid']);
            // dd($params['catid']);
        }
        return $builder;
    }
}
