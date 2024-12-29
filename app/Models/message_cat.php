<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message_cat extends Model
{
    use HasFactory, date_convert;
    protected $fillable=[
        'admin_id',
        'title',
        'email',
        'catid',
        'order',
        'state',
    ];

    public function sub_cats(){
        return $this->hasMany(message_cat::class,'catid')->select("id","title","catid");
    }

    public function sub_cats_site(){
        return $this->hasMany(message_cat::class,'catid')->select("id","title","catid")->where("state","1");
    }

    public function scopeFilter(Builder $builder,$params){
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
}