<?php

namespace App\Models;

use App\Trait\date_convert;
use App\View\Components\admin\select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class menu extends Model
{
    use HasFactory, SoftDeletes, date_convert;
    protected $table="menu";
    protected $appends = ['type_name','link','alt_image'];
    protected $fillable = [
        'title', 
        'pic', 
        'type', 
        'alt_pic', 
        'state', 
        'order',
        'open_type', 
        'catid',
        'select_page',
        'url',
        'pages'
    ];

    public function getAltImageAttribute()
    {
        return !empty($this->alt_pic) ? $this->alt_pic : $this->title;
    }

    public function getTypeNameAttribute()
    {
        return trans('common.menu_kind')[$this->type];
    }

    public function getLinkAttribute(){
        //LaravelLocalization::localizeUrl  => support multi language
        if($this->select_page=='1'){
            // return LaravelLocalization::localizeUrl('/pages/'.$this->pages);
            return '/pages/'.$this->pages;
        }elseif($this->url=='#'){
            return "javascript:void(0)";
        }else{
            if(preg_match('/^(http|https)/',$this->url)){
                return $this->url;
            }else{
                // return LaravelLocalization::localizeUrl("/".$this->url);
                return "/".$this->url;
            }
        }
    }

    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['title'])) {
            $builder->where('title', 'like', '%' . $params['title'] . '%');
        }
        if (!empty($params['type'])) {
            $builder->where('type', $params['type']);
        }
        if(!empty($params['catid'])){
            $builder->where("catid",$params["catid"]);
        }else{
            $builder->where("catid",'0');
        }
        return $builder;
    }

    public function sub_menus(){
        return $this->hasMany(menu::class,'catid')->select("id","title","catid");
        // return $this->hasMany(menu::class,'catid')->with('sub_menus')->select("id","title","catid");
    }

    public function sub_menus_site(){
        // "id","title","catid","select_page","pages","url"
        return $this->hasMany(menu::class,'catid')->where("state","1");
    }

}
