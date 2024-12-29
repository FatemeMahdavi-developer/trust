<?php

namespace App\Models;

use App\Trait\date_convert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use HasFactory,SoftDeletes,date_convert;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'username',
        'mobile',
        'email',
        'city',
        'pic',
        'province',
        'is_main',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function scopeFilter(Builder $builder,$params=[]){
        if(!empty($params["fullname"])){
            $builder->where('fullname', 'like', '%' . $params["fullname"] . '%');
        }
        if(!empty($params["username"])){
            $builder->where('username', 'like', '%' . $params["username"] . '%');
        }
        if(!empty($params["mobile"])){
            $builder->where('mobile', 'like', '%' . $params["mobile"] . '%');
        }
        if(!empty($params["email"])){
            $builder->where('email', 'like', '%' . $params["email"] . '%');
        }
        if(!empty($params["role_id"])){
            $builder->where('role_id',$params["role_id"]);
        }
        return $builder;
    }


    public function role(){
        return $this->belongsTo(role::class,"role_id");
    }
}
