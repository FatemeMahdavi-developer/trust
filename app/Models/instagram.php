<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class instagram extends Model
{
    use HasFactory,SoftDeletes,date_convert;
    protected $table="instagram";
    protected $fillable=['title','alt_pic','link','pic','state','state_main','order'];
    protected $appends=["alt_image"];
    public function scopeFilter(Builder $builder, $params)
    {
        if (!empty($params['title'])) {
            $builder->where('title', 'like', '%' . $params['title'] . '%');
        }
        return $builder;
    }
    public function getAltImageAttribute(){
        if(empty($this->alt_pic)){
            return $this->title;
        }
        return $this->alt_pic;
    }
}
