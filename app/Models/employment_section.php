<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employment_section extends Model
{
    use HasFactory,SoftDeletes,date_convert;

    protected $fillable=[
        'admin_id',
        'name',
        'state',
        'order',
    ];

    public function scopeFilter(Builder $builder,$params){
        if(!empty($params['name'])){
            $builder->where("name",'like','%'.$params['name'].'%');
        }
    }
}
