<?php

namespace App\Models;

use App\Trait\date_convert;
use App\Trait\morph_content;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class page extends Model
{
    use HasFactory,SoftDeletes,date_convert,morph_content;
    protected $appends=['alt_image'];
    protected $fillable = [
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
        'kind',
        'pic',
        'alt_pic',
        'state',
        'note',
    ];
    public function scopeFilter(Builder $builder , $params){
        if(!empty($params['kind'])){
            $builder->where("kind",$params["kind"]);
        }
        if(!empty($params['title'])){
            $builder->where('title', 'like', '%' . $params["title"] . '%');
        }
        return $builder;
    }

    public function getAltImageAttribute()
    {
        return !empty($this->alt_pic) ? $this->alt_pic : $this->title;
    }
}
