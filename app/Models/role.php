<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class role extends Model
{
    use HasFactory,SoftDeletes,date_convert;
    protected $fillable=["title","admin_id"];

    public function permission(){
        return $this->belongsToMany(permissions::class);
    }
    public function scopeFilter(Builder $builder , $params){
        if(!empty($params['kind'])){
            $builder->where("kind",$params["kind"]);
        }
        if(!empty($params['title'])){
            $builder->where('title', 'like', '%' . $params["title"] . '%');
        }
        return $builder;
    }

}
